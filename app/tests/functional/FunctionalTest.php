<?php

class FunctionalTest extends TestCase
{
    public function testWorks()
    {
        $this->assertTrue(True);
    }

    public function testIndexPageCanOpen()
    {
        $result = $this->call('GET', '/');
        $this->assertResponseOK();
        $this->assertNotContains('Hello World!', $result->getContent());
    }

    public function testIndexPageIsTodoApp()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('h1:contains("To-Do List")'), 'should have h1 with "To-Do List"');
    }

    public function testTodoAppHasTabs()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertCount(1, $crawler->filter('ul#tabs'), 'todo app should have tabs');
        $this->assertCount(1, $crawler->filter('ul#tabs')->filter('li#todo_tab'), 'should have todo tab');
    }

    public function testTodoAppHasContainerSectionWithTabsAndMain()
    {
        $crawler = $this->client->request('GET', '/');
        $container = $crawler->filter('div#container');

        $this->assertCount(1, $container);
        $this->assertCount(1, $container->filter('h1'), 'should have h1');
        $this->assertCount(1, $container->filter('ul#tabs'), 'should have tabs');
        $this->assertCount(1, $container->filter('div#main'), 'should have main div' );
    }

    public function testMainSectionHasAppropriateSubs()
    {
        $crawler = $this->client->request('GET', '/');
        $main = $crawler->filter('div#container')->filter('div#main');
        $this->assertCount(1, $main->filter('div#todo'), 'should have todo section');
        $this->assertCount(1, $main->filter('div#addNew'), 'should have addNew section');
    }

    public function testFormInAddNewSection()
    {
        $crawler = $this->client->request('GET', '/');
        $section = $crawler->filter('div#container')->filter('div#main')->filter('div#addNew');
        $this->assertCount(1, $section->filter('form'));
        $form = $section->filter('form');
        $this->assertCount(1, $form->filter('input#title'), 'should have title');
        $this->assertCount(1, $form->filter('textarea#description'), 'should have description');
        $descr = $form->filter('textarea#description');
        $this->assertEquals('35', $descr->attr('cols'));
        $this->assertEquals('submit', $form->filter('input')->last()->attr('type'), 'should have submit button');
        $this->assertEquals(URL::to('todo'), $form->attr('action'));
        $this->assertEquals('POST', $form->attr('method'));
    }

    public function testIndexPageGetsDataFromController()
    {
        $result = $this->call('GET', '/');
        $this->assertViewHas('items');
    }
}