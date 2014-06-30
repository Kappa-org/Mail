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

use Nette\Object;

/**
 * Class MessageContainer
 * @package Kappa\Mail
 */
class MessageContainer extends Object
{
	/** @var \Kappa\Mail\MessageBuilder */
	private $builder;

	/** @var array */
	private $messages = [];

	/**
	 * @param MessageBuilder $builder
	 */
	public function __construct(MessageBuilder $builder)
	{
		$this->builder = $builder;
	}

	/**
	 * @param string $name
	 * @param array $options
	 * @return $this
	 */
	public function addMessage($name, array $options)
	{
		$this->messages[$name] = $this->builder->createMessage($options);

		return $this;
	}

	/**
	 * @param string $name
	 * @return \Nette\Mail\Message|null
	 */
	public function getMessage($name)
	{
		return isset($this->messages[$name]) ? $this->messages[$name] : null;
	}
} 