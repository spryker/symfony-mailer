<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SymfonyMailer\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface SymfonyMailerToLocaleFacadeInterface
{
    public function getCurrentLocale(): LocaleTransfer;
}
