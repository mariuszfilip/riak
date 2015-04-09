<?php

/*
Copyright 2014 Basho Technologies, Inc.

Licensed to the Apache Software Foundation (ASF) under one or more contributor license agreements.  See the NOTICE file
distributed with this work for additional information regarding copyright ownership.  The ASF licenses this file
to you under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance
with the License.  You may obtain a copy of the License at

  http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an
"AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.  See the License for the
specific language governing permissions and limitations under the License.
*/

namespace Basho\Riak\Command\Object;

use Basho\Riak\Api\Translators\SecondaryIndexHeaderTranslator;
use Basho\Riak\Command;
use Basho\Riak\CommandInterface;

/**
 * Class Store
 *
 * Riak key value object store
 *
 * @author Christopher Mancini <cmancini at basho d0t com>
 */
class Store extends Command\Object implements CommandInterface
{
    protected $method = 'POST';

    public function __construct(Command\Builder\StoreObject $builder)
    {
        parent::__construct($builder);

        $this->object = $builder->getObject();
        $this->bucket = $builder->getBucket();
        $this->location = $builder->getLocation();

        if ($this->location) {
            $this->method = 'PUT';
        }

        $this->headers = array_merge($this->headers, $this->object->getHeaders());
    }

    public function getHeaders()
    {
        $translator = new SecondaryIndexHeaderTranslator();
        $indexHeaders = $translator->createHeadersFromIndexes($this->object->getIndexes());
        return array_merge(parent::getHeaders(), $indexHeaders);
    }
}