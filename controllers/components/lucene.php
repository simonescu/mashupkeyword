<?php
/* SVN FILE: $Id: searchable.php 689 2008-11-05 10:30:07Z AD7six $ */
// modified by cthorn
/**
 * Short description for searchable.php
 *
 * Long description for searchable.php
 *
 * PHP 5
 *
 * Copyright (c) 2008, Marcin Domanski
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2008, Marcin Domanski
 * @link          www.kabturek.info
 * @package
 * @subpackage    projects.cookbook.models.behaviors
 * @since         v 0.1
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class LuceneComponent extends Object
{

    /**
     * Controller Startup Initialisation
     * Add APP/vendor to include path
     *
     * @throws Exception
     */
    public function startup() {
        $include = get_include_path();
        $include.= PATH_SEPARATOR. APP . 'vendors' . DS;
        $successful = set_include_path($include);
        if (!$successful) {
            throw new Exception('ZendComponent failed to set include path.', E_ERROR);
        }
        require_once('Zend/Loader.php');

        Zend_Loader::registerAutoload();
    }

   protected $search;
   public function insertFromDB($since)
   {
        $doc = new Zend_Search_Lucene_Document();
        $doc->addField(Zend_Search_Lucene_Field::Keyword('id', $row['id']));
        $doc->addField(Zend_Search_Lucene_Field::Keyword('person', $row['person']));
        $doc->addField(Zend_Search_Lucene_Field::Text('celeb_type', $row['celeb_type']));
        $doc->addField(Zend_Search_Lucene_Field::Text('wikikeyword', $row['wikikeyword']));
        $doc->addField(Zend_Search_Lucene_Field::Text('blurb', $row['blurb']));
        $this->search->addDocument($doc);
   }


   public function load($module)
   {
           // Set the default analyzer to one that supports searching on purely numeric values.

           Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_TextNum_CaseInsensitive());

           // Check the module already has a index directory. If it does not have one, create it.

           if(!is_dir(TMP . DS .'indexdata/' . $module)) {
               //throw exception
           }
           else {
              $this->search = Zend_Search_Lucene::open(TMP . DS .'indexdata/' . $module);
           }

           // Set some baseline performance options.

           $this->search->setMaxBufferedDocs(100);
           $this->search->setMergeFactor(10);

           // As part of good general practice, optimize the index.

           //echo 'Running optimization on index data for module "' . $module . '".', 'general';
           $this->search->optimize();
           //echo 'Finished loading ' . number_format($this->search->numDocs()) . ' records for module "' . $module . '".', 'general';
   }

   public function query($params)
   {
           // Params Structure:
           //                                      type : The name of the module you're searching.
           //                                      query : The raw lucene query to run.
           //                                      limit : The maximum number of rows to return.
           //                                      offset : The number of results to skip in the return.
           //                                      sort : The field to sort on.
           //                                      sort-order: The direction to sort on that field.

           global $cacheManager, $protocolHandler, $socketManager, $Logger;

           // If they don't specify a limit, set a default.

           if(!isset($params['limit']))
                   $params['limit'] = 10;

           // If They don't specify a offset, assume zero.

           if(!isset($params['offset']))
                   $params['offset'] = 0;

           // Call the cache and see if we already have the results for this search.
           // If yes, send that instead. If not, proceed to running the query.
           //$cacheresults = $cacheManager->get($protocolHandler->encode($params));
           $cacheresults = false;

           if($cacheresults !== false)
           {
                   //$Logger->add('Found results for query "' . $params['query'] . '" in module "' . $params['type'] . '" in cache, sending back cached result.', 'queries');
                   //$results = $protocolHandler->decode($cacheresults);
                   //return($results);
           }
           else
           {
                   //$Logger->add('Results for query "' . $params['query'] . '" in module "' . $params['type'] . '" not found in cache, executing against index.', 'queries');

                   // Copy the now complete but un-modified params array to a
                   // temporary variable to be used later for the caching key.

           //      $cachekey = $params;

                   // ********************
                   // **** Sort Logic ****
                   // ********************

                   $resultreverse = false;

                   if(isset($params['sort']) && isset($params['sort-order']))
                   {
                           // Check to see if we're being requested to sort by score (which is the default).

                           if($params['sort'] == 'score')
                           {
                                   // Check to see if we're being asked to sort in descending order. If so,
                                   // we'll simply flip the result set in PHP and therefore should not send it
                                   // to the search library.

                                   if(isset($params['sort-order']) && $params['sort-order'] == SORT_ASC)
                                           $resultreverse = true;

                                   // Since score is the default, don't send it to the
                                   // search library. Also, if the order is ascending
                                   // thats the default and if its descending we're
                                   // handling it in PHP, so don't send sort order either.

                                   unset($params['sort'], $params['sort-order']);
                           }
                           else
                           {
                                   // Convert the string based sort order to the defined library variables.

                                   if(!isset($params['sort-order']) || $params['sort-order'] == 'desc')
                                           $params['sort-order'] = SORT_DESC;
                                   else
                                           $params['sort-order'] = SORT_ASC;
                           }
                   }

                   // *******************
                   // **** Run Query ****
                   // *******************

                   if(isset($params['sort']) && isset($params['sort-order']))
                           $results = $this->search->find($params['query'], $params['sort'], SORT_REGULAR, $params['sort-order']);
                   else
                           $results = $this->search->find($params['query']);

                   $finalresults = array();
                   $resultcount = count($results);

                   echo $resultcount . ' rows found for query "' . $params['query'] . '" in module "' . $params['type'] . '".', 'queries';

                   if($resultcount > 0)
                   {
                           // Use the first row of the result set to get
                           // the field names for recursive processing.

                           $fields = $results[0]->getDocument()->getFieldNames();

                           // *****************************
                           // **** Isolate Return Rows ****
                           // *****************************

                           $stoppoint = $params['offset'];

                           if($resultcount <= $params['limit'])
                                   $stoppoint += $resultcount;
                           else
                                   $stoppoint += $params['limit'];

                           // *****************************************************************
                           // **** Loop Through Isolated Rows (Building Associative Array) ****
                           // *****************************************************************

                           if($resultreverse)
                                   $results = array_reverse($results);

                           for($counter = $params['offset']; $counter < $stoppoint; $counter++)
                           {
                                   $doc = $results[$counter];

                                   $row = array();

                                   // Convert the object result to an array value.

                                   foreach($fields AS $curfield)
                                           $row[$curfield] = $doc->$curfield;

                                   // Append the lucene score for reach result.

                                   $row['_score'] = $doc->score;

                                   $finalresults[] = $row;
                           }
                   }

                   // Use the unmodified search parameters as the key and the end final search result as the value to cache this search.

                   //echo 'Caching ' . $resultcount . ' rows found for query "' . $params['query'] . '" in module "' . $params['type'] . '".', 'queries';
                   //$cacheManager->set($protocolHandler->encode($cachekey), $protocolHandler->encode($finalresults));

                   return($finalresults);
           }
   }


}



