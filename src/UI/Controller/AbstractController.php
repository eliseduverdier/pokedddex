<?php

namespace App\UI\Controller;

use JMS\Serializer\SerializerBuilder;

abstract class AbstractController
{
    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->addMetadataDir('../resources/config/serializer/')
            ->build();
    }
}
