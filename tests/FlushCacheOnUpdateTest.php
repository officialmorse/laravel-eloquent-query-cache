<?php

namespace Rennokki\QueryCache\Test;

use Rennokki\QueryCache\Test\Models\Page;

class FlushCacheOnUpdateTest extends TestCase
{
    public function test_flush_cache_on_create()
    {
        $page = factory(Page::class)->create();
        $storedPage = Page::cacheFor(now()->addHours(1))->first();
        $cache = $this->getCacheWithTags('leqc:sqlitegetselect * from "pages" limit 1a:0:{}', [
            'test',
            "Rennokki\QueryCache\Test\Models\Page_{$storedPage->id}",
        ]);

        $this->assertNotNull($cache);

        $this->assertEquals(
            $cache->first()->id,
            $storedPage->id
        );

        Page::create([
            'name' => '9GAG',
        ]);

        $cache = $this->getCacheWithTags('leqc:sqlitegetselect * from "pages" limit 1a:0:{}', [
            'test',
            "Rennokki\QueryCache\Test\Models\Page_{$storedPage->id}",
        ]);

        $this->assertNull($cache);
    }

    public function test_flush_cache_on_update()
    {
        $page = factory(Page::class)->create();
        $storedPage = Page::cacheFor(now()->addHours(1))->first();
        $cache = $this->getCacheWithTags('leqc:sqlitegetselect * from "pages" limit 1a:0:{}', [
            'test',
            "Rennokki\QueryCache\Test\Models\Page_{$storedPage->id}",
        ]);

        $this->assertNotNull($cache);

        $this->assertEquals(
            $cache->first()->id,
            $storedPage->id
        );

        $page->update([
            'name' => '9GAG',
        ]);

        $cache = $this->getCacheWithTags('leqc:sqlitegetselect * from "pages" limit 1a:0:{}', [
            'test',
            "Rennokki\QueryCache\Test\Models\Page_{$storedPage->id}",
        ]);

        $this->assertNull($cache);
    }

    public function test_flush_cache_on_delete()
    {
        $page = factory(Page::class)->create();
        $storedPage = Page::cacheFor(now()->addHours(1))->first();
        $cache = $this->getCacheWithTags('leqc:sqlitegetselect * from "pages" limit 1a:0:{}', [
            'test',
            "Rennokki\QueryCache\Test\Models\Page_{$storedPage->id}",
        ]);

        $this->assertNotNull($cache);

        $this->assertEquals(
            $cache->first()->id,
            $storedPage->id
        );

        $page->delete();

        $cache = $this->getCacheWithTags('leqc:sqlitegetselect * from "pages" limit 1a:0:{}', [
            'test',
            "Rennokki\QueryCache\Test\Models\Page_{$storedPage->id}",
        ]);

        $this->assertNull($cache);
    }

    public function test_flush_cache_on_force_deletion()
    {
        $page = factory(Page::class)->create();
        $storedPage = Page::cacheFor(now()->addHours(1))->first();
        $cache = $this->getCacheWithTags('leqc:sqlitegetselect * from "pages" limit 1a:0:{}', [
            'test',
            "Rennokki\QueryCache\Test\Models\Page_{$storedPage->id}",
        ]);

        $this->assertNotNull($cache);

        $this->assertEquals(
            $cache->first()->id,
            $storedPage->id
        );

        $page->forceDelete();

        $cache = $this->getCacheWithTags('leqc:sqlitegetselect * from "pages" limit 1a:0:{}', [
            'test',
            "Rennokki\QueryCache\Test\Models\Page_{$storedPage->id}",
        ]);

        $this->assertNull($cache);
    }
}
