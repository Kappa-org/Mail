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
use Kappa\Tester\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Class MessageBuilderTest
 * @package Kappa\Mail\Tests
 */
class MessageBuilderTest extends TestCase
{
	/** @var \Kappa\Mail\MessageBuilder */
	private $messageBuilder;

	protected function setUp()
	{
		$this->messageBuilder = new MessageBuilder();
	}

	public function testCreateMessage()
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
		$message = $this->messageBuilder->createMessage($options);
		Assert::equal(['test@from.com' => 'Budry'], $message->getFrom());
		Assert::same('1000', $message->getPriority());
		Assert::same('return/path', $message->getReturnPath());
		Assert::same('Subject', $message->getSubject());

		Assert::throws(function () {
			$this->messageBuilder->createMessage(['no' => 'no']);
		}, 'Kappa\Mail\InvalidArgumentException');
	}
}

\run(new MessageBuilderTest());