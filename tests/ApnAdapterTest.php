<?php

namespace NotificationChannels\Apn\Tests;

use DateTime;
use NotificationChannels\Apn\ApnAdapter;
use NotificationChannels\Apn\ApnMessage;

class ApnAdapterTest extends TestCase
{
    protected $adapter;

    public function setUp(): void
    {
        $this->adapter = new ApnAdapter;
    }

    /** @test */
    public function it_adapts_title()
    {
        $message = (new ApnMessage)->title('title');

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertEquals('title', $notification->getPayload()->getAlert()->getTitle());
    }

    /** @test */
    public function it_adapts_body()
    {
        $message = (new ApnMessage)->body('body');

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertEquals('body', $notification->getPayload()->getAlert()->getBody());
    }

    /** @test */
    public function it_adapts_content_available()
    {
        $message = (new ApnMessage)->contentAvailable(true);

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertTrue($notification->getPayload()->isContentAvailable());
    }

    /** @test */
    public function it_adapts_mutable_content()
    {
        $message = (new ApnMessage)->mutableContent(true);

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertTrue($notification->getPayload()->hasMutableContent());
    }

    /** @test */
    public function it_adapts_badge()
    {
        $message = (new ApnMessage)->badge(1);

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertEquals(1, $notification->getPayload()->getBadge());
    }

    /** @test */
    public function it_adapts_badge_clear()
    {
        $message = (new ApnMessage)->badge(0);

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertSame(0, $notification->getPayload()->getBadge());
    }

    /** @test */
    public function it_adapts_sound()
    {
        $message = (new ApnMessage)->sound('sound');

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertEquals('sound', $notification->getPayload()->getSound());
    }

    /** @test */
    public function it_adapts_category()
    {
        $message = (new ApnMessage)->category('category');

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertEquals('category', $notification->getPayload()->getCategory());
    }

    /** @test */
    public function it_adapts_custom()
    {
        $message = (new ApnMessage)->custom('key', 'value');

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertEquals('value', $notification->getPayload()->getCustomValue('key'));
    }

    /** @test */
    public function it_adapts_push_type()
    {
        $message = (new ApnMessage)->pushType('push type');

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertEquals('push type', $notification->getPayload()->getPushType());
    }

    /** @test */
    public function it_adapts_expires_at()
    {
        $expiresAt = new DateTime('2000-01-01');

        $message = (new ApnMessage)->expiresAt($expiresAt);

        $notification = $this->adapter->adapt($message, 'token');

        $this->assertEquals($expiresAt, $notification->getExpirationAt());
    }
}
