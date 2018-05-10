<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\RelationNotFoundException;

class API {
	/**
	 * Marshall a single resource to JSON API.
	 * @param  [[Type]] $entry [[Description]]
	 * @param  [[Type]] $type  [[Description]]
	 * @return [[Type]] [[Description]]
	 */
	public function marshallEntry($item, $type)
	{
		$document = new \stdClass;

		// Detect relationships
		$relations = $this->loadRelations($item);

		// Prepare resource
		$document->data = $this->formatResource($item, $type, $relations);

		if(count($relations) > 0){
			$document->included = array();
			$acc = array();

			$this->buildIncluded($document, $item, $relations, $acc);
		}

		return $document;
	}

	/**
	 * Marshall a data set to JSON API.
	 * @param  [[Type]] $dataSet [[Description]]
	 * @param  [[Type]] $type    [[Description]]
	 * @return [[Type]] [[Description]]
	 */
	public function marshallDataset($dataSet, $type)
	{
		$payload = new \stdClass;
		$payload->data = array();
		$acc = array();

		$dataSet->each(function ($item) use ($payload, $type, $acc) {
			$relations = $this->loadRelations($item);

			$payload->data[] = $this->formatResource($item, $type, $relations);

			if(count($relations) > 0){
				if(!property_exists($payload, 'included')){
					$payload->included = array();
				}

				$this->buildIncluded($payload, $item, $relations, $acc);
			}
		});

		return $payload;
	}

	/**
	 * Load relations for a model.
	 * @param  [[Type]] $entry [[Description]]
	 * @return [[Type]] [[Description]]
	 */
	private function loadRelations($entry){
		$base_methods = get_class_methods('Illuminate\Database\Eloquent\Model');
		$model_methods = get_class_methods(get_class($entry));
		$maybe_relations = array_diff($model_methods, $base_methods);
		$confirmed_relations = array();

		foreach($maybe_relations as $relation_name) {
			try{
				$entry->load($relation_name);
				$confirmed_relations[] = $relation_name;
			}
			catch(RelationNotFoundException $e){

			}
		}

		return $confirmed_relations;
	}

	/**
	 * Format a single resource.
	 * @param  [[Type]] $resource [[Description]]
	 * @param  [[Type]] $type     [[Description]]
	 * @return [[Type]] [[Description]]
	 */
	private function formatResource($resource, $type, $relations = array()){
		$entry = new \stdClass;
		$entry->type = $type;
		$entry->id = $resource->id;
		$entry->attributes = new \stdClass;

		$blacklist = array('id', 'pivot');

		foreach($resource->toArray() as $propName => $propVal){
			$isRelation = in_array($propName, $relations);

			if(!in_array($propName, $blacklist) &&! $isRelation){
				$entry->attributes->$propName = $propVal;
			}

			if($isRelation){
				// Add relationship identifier
				if(!property_exists($entry, 'relationships')){
					$entry->relationships = new \stdClass;
					$entry->relationships->{$propName} = new \stdClass;
					$entry->relationships->{$propName}->data = array();
				}

				$collection = $resource->{$propName}()->get();

				foreach($collection as $relatedItem){
					$identifier = new \stdClass;
					$identifier->type = str_singular($propName);
					$identifier->id = $relatedItem->id;
					$entry->relationships->{$propName}->data[] = $identifier;
				}
			}
		}

		return $entry;
	}

	/**
	 * Format included resources.
	 * @param [[Type]] &$document [[Description]]
	 * @param [[Type]] $item      [[Description]]
	 * @param [[Type]] $relations [[Description]]
	 * @param [[Type]] &$acc      [[Description]]
	 */
	private function buildIncluded(&$document, $item, $relations, &$acc){
		foreach($relations as $relationName){
			${$relationName} = $item->{$relationName}()->get();
			foreach(${$relationName} as $relation){
				if(!in_array($relationName . $relation->id, $acc)){
					$acc[] = $relationName . $relation->id;
					$document->included[] = $this->formatResource(
						$relation,
						str_singular($relationName)
						// $this->loadRelations($relation)
					);
				}
			}
		}
	}
}
