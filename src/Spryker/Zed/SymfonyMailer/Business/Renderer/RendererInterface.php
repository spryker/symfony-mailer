<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SymfonyMailer\Business\Renderer;

use Generated\Shared\Transfer\MailTransfer;

interface RendererInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function render(MailTransfer $mailTransfer): void;
}
