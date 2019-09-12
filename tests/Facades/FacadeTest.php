<?php

declare(strict_types=1);

namespace NorseBlue\ObjectFacades\Tests\Facades;

use Exception;
use NorseBlue\ObjectFacades\Exceptions\InvalidFacadeTargetClassException;
use NorseBlue\ObjectFacades\Tests\Helpers\CreatableSubjectFacade;
use NorseBlue\ObjectFacades\Tests\Helpers\InvalidSubjectFacade;
use NorseBlue\ObjectFacades\Tests\Helpers\Subject;
use NorseBlue\ObjectFacades\Tests\Helpers\SubjectExtension;
use NorseBlue\ObjectFacades\Tests\Helpers\SubjectFacade;
use NorseBlue\ObjectFacades\Tests\Helpers\SubjectStaticExtension;
use NorseBlue\ObjectFacades\Tests\TestCase;

class FacadeTest extends TestCase
{
    protected function setUp(): void
    {
        Subject::registerExtensionMethod('pow', SubjectExtension::class);
        Subject::registerExtensionMethod('swapSign', SubjectStaticExtension::class);
    }

    /** @test */
    public function can_call_object_method_from_facade()
    {
        $result_0 = SubjectFacade::mult(1000, 0);
        $result_1 = SubjectFacade::mult(1);
        $result_2 = SubjectFacade::mult(1, 3);
        $result_3 = SubjectFacade::mult(3);
        $result_4 = SubjectFacade::mult(3, 3);
        $result_5 = SubjectFacade::mult(7);
        $result_6 = SubjectFacade::mult(7, 3);

        $this->assertEquals(0, $result_0);
        $this->assertEquals(2, $result_1);
        $this->assertEquals(3, $result_2);
        $this->assertEquals(6, $result_3);
        $this->assertEquals(9, $result_4);
        $this->assertEquals(14, $result_5);
        $this->assertEquals(21, $result_6);
    }

    /** @test */
    public function can_call_creatable_object_method_from_facade()
    {
        $result_0 = CreatableSubjectFacade::mult(1000, 0);
        $result_1 = CreatableSubjectFacade::mult(1);
        $result_2 = CreatableSubjectFacade::mult(1, 3);
        $result_3 = CreatableSubjectFacade::mult(3);
        $result_4 = CreatableSubjectFacade::mult(3, 3);
        $result_5 = CreatableSubjectFacade::mult(7);
        $result_6 = CreatableSubjectFacade::mult(7, 3);

        $this->assertEquals(0, $result_0);
        $this->assertEquals(2, $result_1);
        $this->assertEquals(3, $result_2);
        $this->assertEquals(6, $result_3);
        $this->assertEquals(9, $result_4);
        $this->assertEquals(14, $result_5);
        $this->assertEquals(21, $result_6);
    }

    /** @test */
    public function can_call_static_class_method_from_facade()
    {
        $result_0 = SubjectFacade::sum(0, 0);
        $result_1 = SubjectFacade::sum(1, 0);
        $result_2 = SubjectFacade::sum(1, 1);
        $result_3 = SubjectFacade::sum(3, 0);
        $result_4 = SubjectFacade::sum(3, 3);
        $result_5 = SubjectFacade::sum(7, 0);
        $result_6 = SubjectFacade::sum(7, 7);

        $this->assertEquals(0, $result_0);
        $this->assertEquals(1, $result_1);
        $this->assertEquals(2, $result_2);
        $this->assertEquals(3, $result_3);
        $this->assertEquals(6, $result_4);
        $this->assertEquals(7, $result_5);
        $this->assertEquals(14, $result_6);
    }

    /** @test */
    public function can_call_static_extension_method_from_facade()
    {
        $result_0 = SubjectFacade::swapSign(0);
        $result_1 = SubjectFacade::swapSign(1);
        $result_2 = SubjectFacade::swapSign(-1);
        $result_3 = SubjectFacade::swapSign(3);
        $result_4 = SubjectFacade::swapSign(-3);
        $result_5 = SubjectFacade::swapSign(7);
        $result_6 = SubjectFacade::swapSign(-7);

        $this->assertEquals(0, $result_0);
        $this->assertEquals(-1, $result_1);
        $this->assertEquals(1, $result_2);
        $this->assertEquals(-3, $result_3);
        $this->assertEquals(3, $result_4);
        $this->assertEquals(-7, $result_5);
        $this->assertEquals(7, $result_6);
    }

    /** @test */
    public function it_throws_exception_when_no_valid_concrete_class_defined_in_facade()
    {
        try {
            InvalidSubjectFacade::unknown();
        } catch (Exception $e) {
            $this->assertInstanceOf(InvalidFacadeTargetClassException::class, $e);

            return;
        }

        $this->fail(InvalidFacadeTargetClassException::class . ' was not thrown.');
    }
}
