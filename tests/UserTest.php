<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCount()
    {
        $collect = new Collect\Collect([13,17]);
        $this->assertSame(2, $collect->count());
    }
    public function testKeys()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2]);
        $this->assertSame(['a', 'b'], $collect->keys()->toArray());
    }

    public function testValues()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2]);
        $this->assertSame([1, 2], $collect->values()->toArray());
    }

    public function testGet()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2]);
        $this->assertSame(1, $collect->get('a'));
    }
    public function testExcept()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame(['a' => 1, 'c' => 3], $collect->except('b')->toArray());
    }

    public function testOnly()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame(['a' => 1, 'b' => 2], $collect->only('a', 'b')->toArray());
    }
    public function testFirst()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame(1, $collect->first());
    }

    public function testSearch()
    {
        $collect = new Collect\Collect([
            ['id' => 1, 'name' => 'Alice'],
            ['id' => 2, 'name' => 'Bob'],
            ['id' => 3, 'name' => 'Alice']
        ]);
        $result = $collect->search('name', 'Alice')->toArray();
        $this->assertSame([['id' => 1, 'name' => 'Alice'], ['id' => 3, 'name' => 'Alice']], $result);
    }

    public function testMap()
    {
        $collect = new Collect\Collect([1, 2, 3]);
        $result = $collect->map(function ($item) {
            return $item * 2;
        })->toArray();
        $this->assertSame([2, 4, 6], $result);
    }

    public function testPush()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2]);
        $collect->push(3, 'c');
        $this->assertSame(['a' => 1, 'b' => 2, 'c' => 3], $collect->toArray());
    }

    public function testUnshift()
    {
        $collect = new Collect\Collect([2, 3]);
        $collect->unshift(1);
        $this->assertSame([1, 2, 3], $collect->toArray());
    }

    public function testShift()
    {
        $collect = new Collect\Collect([1, 2, 3]);
        $collect->shift();
        $this->assertSame([2, 3], $collect->toArray());
    }

    public function testPop()
    {
        $collect = new Collect\Collect([1, 2, 3]);
        $collect->pop();
        $this->assertSame([1, 2], $collect->toArray());
    }
}