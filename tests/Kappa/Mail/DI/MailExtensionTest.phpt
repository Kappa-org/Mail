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

use Kappa\Tester\TestCase;
use Nette\DI\Container;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * Class MailExtensionTest
 * @package Kappa\Mail\Tests
 */
class MailExtensionTest extends TestCase
{
	/** @var \Nette\DI\Container */
	private $container;

	/**
	 * @param Container $container
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	public function testMessageBuilder()
	{
		$service = $this->container->getByType('Kappa\Mail\MessageBuilder');
		Assert::type('Kappa\Mail\MessageBuilder', $service);
	}

	public function testMessageFactory()
	{
		$service = $this->container->getByType('Kappa\Mail\MessageFactory');
		Assert::type('Kappa\Mail\MessageFactory', $service);
	}

	public function testMessageContainer()
	{
		$service = $this->container->getByType('Kappa\Mail\MessageContainer');
		Assert::type('Kappa\Mail\MessageContainer', $service);
		$message = $service->getMessage('noreply');
		Assert::type('Nette\Mail\Message', $message);
		Assert::equal(['noreply@example.com' => null], $message->getFrom());
	}
}

\run(new MailExtensionTest(getContainer()));