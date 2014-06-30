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

use Nette\Application\Application;
use Nette\Application\UI\ITemplateFactory;
use Nette\Object;

/**
 * Class MessageFactory
 * @package Kappa\Mail
 */
class MessageFactory extends Object
{
	/** @var \Kappa\Mail\MessageContainer */
	private $messageContainer;

	/** @var \Nette\Application\Application */
	private $application;

	/**
	 * @param MessageContainer $messageContainer
	 * @param Application $application
	 */
	public function __construct(MessageContainer $messageContainer, Application $application)	{
		$this->messageContainer = $messageContainer;
		$this->application = $application;
	}

	/**
	 * @param string $section
	 * @param string $file
	 * @param array $data
	 * @return \Nette\Mail\Message|null
	 */
	public function createMessage($section, $file = null, array $data = [])
	{
		$message = $this->messageContainer->getMessage($section);
		if (!$message) {
			return null;
		}
		if ($file) {
			$template = $this->getTemplate($file, $data);
			$message->setHtmlBody($template);
		}

		return $message;
	}

	/**
	 * @param string $file
	 * @param array $data
	 * @return \Nette\Application\UI\ITemplate
	 */
	private function getTemplate($file, array $data)
	{
		$template = $this->application->getPresenter()->getTemplate();
		$template->setFile($file);
		foreach ($data as $name => $value) {
			$template->add($name, $value);
		}

		return $template;
	}
} 