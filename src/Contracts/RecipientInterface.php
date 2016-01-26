<?php

namespace Tjphippen\Docusign\Contracts;


interface RecipientInterface
{
    /**
     * The recipients email address
     *
     * @return string
     */
    public function email();

    /**
     * The recipients full name
     *
     * @return string
     */
    public function name();

    /**
     * The role name of the recipient in relation to the document
     *
     * @return string
     */
    public function role();

    /**
     * Return the ID of the recipient.
     *
     * Used for embedded signing
     *
     * @return string
     */
    public function identity();
}
