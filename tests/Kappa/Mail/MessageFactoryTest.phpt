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

use Kappa\Mail\MessageFactory;
use Kappa\Tester\MockTestCase;
use Nette\Mail\Message;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Class MessageFactoryTest
 * @package Kappa\Mail\Tests
 */
class MessageFactoryTest extends MockTestCase
{
	/** @var \Kappa\Mail\MessageFactory */
	private $messageFactory;

	protected function setUp()
	{
		parent::setUp();
		$applicationMock = $this->mockista->create('Nette\Application\Application');
		$messageContainerMock = $this->mockista->create('Kappa\Mail\MessageContainer', [
			'getMessage' => new Message()
		]);
		$this->messageFactory = new MessageFactory($messageContainerMock, $applicationMock);
	}

	public function testCreateMessage()
	{
		Assert::type('Nette\Mail\Message', $this->messageFactory->createMessage('test'));
	}
}

\run(new MessageFactoryTest());