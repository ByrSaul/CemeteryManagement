<?php

namespace CemeteryManagement\Contracts\ValueObjects\Collections;

use JsonSerializable;

/**
 * Contract for collectable objects
 * It extends JSONSerializable to include this dependency
 *
 * @package CemeteryManagement
 */
interface IsCollectable extends JsonSerializable
{
}
