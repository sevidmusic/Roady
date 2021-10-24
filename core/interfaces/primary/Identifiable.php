<?php

namespace roady\interfaces\primary;

/**
 * This interface defines an object that can be identified
 * by an alpha-numeric name, and a unique alpha-numeric id.
 */
interface Identifiable
{

    /**
     * @return string An alpha-numeric name.
     */
    public function getName(): string;

    /**
     * @return string A unique alpha-numeric id.
     */
    public function getUniqueId(): string;

}
