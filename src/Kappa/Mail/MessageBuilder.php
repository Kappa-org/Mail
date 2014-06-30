<?php
/**
 * This file is part of the Kappa\Mail package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\Mail;

use Nette\Mail\Message;
use Nette\Object;
use Nette\Utils\Callback;

/**
 * Class MessageBuilder
 * @package Kappa\Mail
 */
class MessageBuilder extends Object
{
	/**
	 * @param array $options
	 * @return Message
	 */
	public function createMessage(array $options)
	{
		$message = new Message();
		$this->configureMessage($message, $options);

		return $message;
	}

	/**
	 * @param Message $message
	 * @param array $options
	 */
	private function configureMessage(Message &$message, array $options)
	{
		foreach ($options as $method => $arguments) {
			if (is_array($arguments)) {
				$method = $this->getMethodName($method, 'add');
				foreach ($arguments as $argument) {
					Callback::invokeArgs([$message, $method], [$argument]);
				}
			} else {
				$method = $this->getMethodName($method, 'set');
				Callback::invokeArgs([$message, $method], [$arguments]);
			}
		}
	}

	/**
	 * @param string $name
	 * @param string $prefix
	 * @return string
	 * @throws InvalidArgumentException
	 */
	private function getMethodName($name, $prefix)
	{
		$methodName = $prefix;
		$methodName .= ucfirst($name);
		if (!method_exists('Nette\Mail\Message', $methodName)) {
			throw new InvalidArgumentException("Invalid option '{$name}'");
		}

		return $methodName;
	}
} 