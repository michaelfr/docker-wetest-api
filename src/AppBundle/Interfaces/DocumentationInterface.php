<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 15/10/17
 * Time: 14:58
 */

namespace AppBundle\Interfaces;

interface DocumentationInterface
{
    const RAML_FORMAT = 'raml';
    const SWAGGER_FORMAT = 'swagger';
    const COLLECTION_OPERATION = 'collection';
    const ITEM_OPERATION = 'item';

}