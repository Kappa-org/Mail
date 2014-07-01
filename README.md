# Kappa\Mail

Package for more comfortable works with Nette\Mail\Message

## Requirements:

* PHP 5.4 or higher
* [nette/di](https://github.com/nette/di) 2.2 or higher
* [nette/mail](https://github.com/nette/mail) 2.2 or higher
* [nette/application](https://github.com/nette/application) 2.2 or higher

## Installation:


The best way to install Kappa\Mail is using Composer

```bat
$ composer require kappa/mail:@dev
```

## Usages

Register extension:

```yaml
extensions:
	messages: Kappa\Mail\DI\MailExtension
```

In config file you can define messages

```yaml
messages:
	messageName:
		option: value
		options:
			- value
```

Message options corresponds with [API](https://github.com/nette/mail/blob/master/src/Mail/Message.php)
```Nette\Mail\Massage``` class

Actual options:

* `from` - string
* `subject` - string
* `returnPath` - string
* `priority` - integer
* `replyTo` - array
* `to` - array
* `cc` array
* `bcc` - array
* `embeddedFile` - array
* `attachment` - array

[Example usage](https://github.com/Kappa-org/Mail/blob/master/tests/Kappa/Mail/MessageBuilderTest.phpt#L37-L48)

In your code:

```php
class Model
{
	private $messageFactory;

	public function __construct(\Kappa\Mail\MessageFactory $messageFactory)
	{
		$this->messageFactory = $messageFactory;
	}

	public function sendMail(array $data)
	{
		$message = $this->messageFactory->createMessage('messageName', 'email_template.latte', $data);
		//...
	}
}
```