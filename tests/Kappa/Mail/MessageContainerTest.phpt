<?php
/**
 * This file is part of the Kappa\Mail package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 * 
 * @testCase
 */

namespace Kappa\Mail\Tests;

use Kappa\Mail\MessageBuilder;
use Kappa\Mail\MessageContainer;
use Kappa\Tester\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Class MessageContainerTest
 * @package Kappa\Mail\Tests
 */
class MessageContainerTest extends TestCase
{
	/** @var \Kappa\Mail\MessageContainer */
	private $messageContainer;

	protected function setUp()
	{
		$this->messageContainer = new MessageContainer(new MessageBuilder());
	}

	public function testMessage()
	{
		$options = [
			'from' => 'Budry <test@from.com>',
			'subject' => 'Subject',
			'returnPath' => 'return/path',
			'priority' => '1000',
			'replyTo' => ['reply1@test.com', 'reply2@test.com'],
			'to' => ['to1@test.com', 'to2@test.com'],
			'cc' => ['cc1@test.com', 'cc2@test.com'],
			'bcc' => ['bcc1@test.com', 'bcc2@test.com'],
			'embeddedFile' => [__FILE__],
			'attachment' => [__FILE__]
		];
		Assert::type(get_class($this->messageContainer), $this->messageContainer->addMessage('test', $options));
		Assert::type('Nette\Mail\Message', $this->messageContainer->getMessage('test'));
		Assert::null($this->messageContainer->getMessage('no'));
	}
}

\run(new MessageContainerTest());