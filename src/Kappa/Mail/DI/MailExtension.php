<?php
/**
 * This file is part of the Kappa\Mail package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\Mail\DI;

use Nette\DI\CompilerExtension;

/**
 * Class MailExtension
 * @package Kappa\Mail\DI
 */
class MailExtension extends CompilerExtension
{
	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();

		$builder->addDefinition($this->prefix('messageBuilder'))
			->setClass('Kappa\Mail\MessageBuilder');

		$builder->addDefinition($this->prefix('messageFactory'))
			->setClass('Kappa\Mail\MessageFactory');

		$messageContainer = $builder->addDefinition($this->prefix('messageContainer'))
			->setClass('Kappa\Mail\MessageContainer');
		foreach ($config as $messageName => $options) {
			$messageContainer->addSetup('addMessage', [$messageName, $options]);
		}
	}
}