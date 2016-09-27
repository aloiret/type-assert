<?hh // strict
/*
 *  Copyright (c) 2016, Fred Emmott
 *  All rights reserved.
 *
 *  This source code is licensed under the ISC license found in the LICENSE
 * file in the root directory of this source tree.
 */

namespace FredEmmott\TypeAssert;

class ScalarsTest extends \PHPUnit\Framework\TestCase {
  public function testIsStringPasses(): void {
    $this->assertSame('foo', TypeAssert::isString('foo'));
  }

  public function testIsStringThrowsForInt(): void {
    $this->expectException(IncorrectTypeException::class);
    TypeAssert::isString(123);
  }

  public function testIsIntPasses(): void {
    $this->assertSame(123, TypeAssert::isInt(123));
  }

  public function testIsIntThrowsForString(): void {
    $this->expectException(IncorrectTypeException::class);
    TypeAssert::isInt('123');
  }

  public function testIsIntThrowsForFloat(): void {
    $this->expectException(IncorrectTypeException::class);
    TypeAssert::isInt(123.0);
  }

  public function testIsFloatPasses(): void {
    $this->assertSame(
      1.23,
      TypeAssert::isFloat(1.23),
    );
  }

  public function testIsFloatThrowsForString(): void {
    $this->expectException(IncorrectTypeException::class);
    TypeAssert::isFloat('123');
  }

  public function testIsFloatThrowsForInt(): void {
    $this->expectException(IncorrectTypeException::class);
    TypeAssert::isFloat(123);
  }

  public function testIsNotNullPasses(): void {
    $this->assertSame(
      123,
      TypeAssert::isNotNull(123),
    );
    $this->assertSame(
      'foo bar',
      TypeAssert::isNotNull('foo bar'),
    );
  }

  public function testIsNotNullThrows(): void {
    $this->expectException(IncorrectTypeException::class);
    TypeAssert::isNotNull(null);
  }

  public function testIsNotNullTypechecks(): void {
    return; // this test is just here for hh_client

    $wants_int = (int $x) ==> {};
    $wants_int(TypeAssert::isNotNull(123));
    $wants_int(TypeAssert::isNotNull(null));

    $wants_string = (string $x) ==> {};
    $wants_string(TypeAssert::isNotNull('foo bar'));
    $wants_string(TypeAssert::isNotNull(null));
  }
}
