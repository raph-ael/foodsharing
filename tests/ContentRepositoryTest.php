<?php

use App\Models\Content;
use App\Repositories\ContentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContentRepositoryTest extends TestCase
{
    use MakeContentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContentRepository
     */
    protected $contentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->contentRepo = App::make(ContentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateContent()
    {
        $content = $this->fakeContentData();
        $createdContent = $this->contentRepo->create($content);
        $createdContent = $createdContent->toArray();
        $this->assertArrayHasKey('id', $createdContent);
        $this->assertNotNull($createdContent['id'], 'Created Content must have id specified');
        $this->assertNotNull(Content::find($createdContent['id']), 'Content with given id must be in DB');
        $this->assertModelData($content, $createdContent);
    }

    /**
     * @test read
     */
    public function testReadContent()
    {
        $content = $this->makeContent();
        $dbContent = $this->contentRepo->find($content->id);
        $dbContent = $dbContent->toArray();
        $this->assertModelData($content->toArray(), $dbContent);
    }

    /**
     * @test update
     */
    public function testUpdateContent()
    {
        $content = $this->makeContent();
        $fakeContent = $this->fakeContentData();
        $updatedContent = $this->contentRepo->update($fakeContent, $content->id);
        $this->assertModelData($fakeContent, $updatedContent->toArray());
        $dbContent = $this->contentRepo->find($content->id);
        $this->assertModelData($fakeContent, $dbContent->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteContent()
    {
        $content = $this->makeContent();
        $resp = $this->contentRepo->delete($content->id);
        $this->assertTrue($resp);
        $this->assertNull(Content::find($content->id), 'Content should not exist in DB');
    }
}
