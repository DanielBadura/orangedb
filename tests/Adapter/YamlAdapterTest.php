<?php declare(strict_types=1);

namespace DavidBadura\OrangeDb\Test\Adapter;

use DavidBadura\OrangeDb\Adapter\FileNotFoundException;
use DavidBadura\OrangeDb\Adapter\YamlAdapter;
use PHPUnit\Framework\TestCase;

/**
 * @author David Badura <d.a.badura@gmail.com>
 */
class YamlAdapterTest extends TestCase
{
    /**
     * @var YamlAdapter
     */
    private $adapter;

    public function setUp()
    {
        $this->adapter = new YamlAdapter(__DIR__.'/../_files/yaml');
    }

    public function testLoad()
    {
        $document = $this->adapter->load('building', 'house');

        $this->assertEquals('House', $document['name']);
    }

    public function testNotFound()
    {
        $this->expectException(FileNotFoundException::class);

        $this->adapter->load('building', 'xxx');
    }

    public function testFindIdentifieres()
    {
        $identifiers = $this->adapter->findIdentifiers('building');

        $this->assertCount(1, $identifiers);
        $this->assertContains('house', $identifiers);
    }
}
