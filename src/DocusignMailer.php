<?php

namespace Tjphippen\Docusign;


use Tjphippen\Docusign\Contracts\DocumentInterface;
use Tjphippen\Docusign\Contracts\RecipientInterface;

class DocusignMailer
{
    /** @var RecipientInterface $recipient  */
    protected $recipient;

    protected $docusign;

    public function __construct(Docusign $docusign)
    {
        $this->docusign = $docusign;
    }

    /**
     * @param RecipientInterface $recipient
     *
     * @return $this
     */
    public function to(RecipientInterface $recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * Create an envelope for the document with one recipient
     *
     * @param DocumentInterface $doc
     * @param bool $draft set to true to save a draft for later
     *
     * @return mixed
     */
    public function send(DocumentInterface $doc, $draft = false)
    {
        $data = [
            "templateRoles" => [
                [
                    'name' => $this->recipient->name(),
                    'email' => $this->recipient->email(),
                    'roleName' => $this->recipient->role()
                ]
            ],
            "emailSubject" => $doc->subject(),
            "emailBlurb" => $doc->blurb(),
            "templateId" => $doc->templateId(),
            "status" => ($draft)? "created" : "sent"
        ];

        return $this->docusign->createEnvelope($data);
    }

    /**
     * Get the signing url for embedded documents
     *
     * @param DocumentInterface $doc
     *
     * @return mixed
     */
    public function getSigningUrl(DocumentInterface $doc)
    {
        $data = [
            "templateRoles" => [
                [
                    'name' => $this->recipient->name(),
                    'email' => $this->recipient->email(),
                    'roleName' => $this->recipient->role(),
                    "clientUserId" => $this->recipient->identity()
                ]
            ],
            "emailSubject" => $doc->subject(),
            "emailBlurb" => $doc->blurb(),
            "templateId" => $doc->templateId(),
            "status" => "sent"
        ];

        return $this->docusign->createEnvelope($data);
    }
}
