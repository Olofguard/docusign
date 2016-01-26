<?php

namespace Tjphippen\Docusign\Contracts;


interface DocumentInterface
{
    /**
     * Get the email subject
     *
     * @return string
     */
    public function subject();

    /**
     * Get the email blurb
     *
     * @return string
     */
    public function blurb();

    /**
     * Get the template id (docusign guid)
     *
     * @return string
     */
    public function templateId();
}
