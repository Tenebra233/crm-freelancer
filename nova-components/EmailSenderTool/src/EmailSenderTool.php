<?php

namespace Rurbani\EmailSenderTool;

use Laravel\Nova\ResourceTool;

class EmailSenderTool extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Email Sender Tool';
    }

    public function issuesRefunds()
    {
        return $this->withMeta(['date' => true]);
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'email-sender-tool';
    }
}
