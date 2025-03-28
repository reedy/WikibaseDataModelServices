<?php

namespace Wikibase\DataModel\Services\Tests\Lookup;

use PHPUnit\Framework\TestCase;
use Wikibase\DataModel\Entity\PropertyId;
use Wikibase\DataModel\Services\Lookup\InMemoryDataTypeLookup;
use Wikibase\DataModel\Services\Lookup\PropertyDataTypeLookupException;

/**
 * @covers \Wikibase\DataModel\Services\Lookup\InMemoryDataTypeLookup
 *
 * @license GPL-2.0-or-later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class InMemoryDataTypeLookupTest extends TestCase {

	public function testGetDataTypeForPropertyThatIsNotSet() {
		$lookup = new InMemoryDataTypeLookup();

		$this->setExpectedException( PropertyDataTypeLookupException::class );

		$lookup->getDataTypeIdForProperty( new PropertyId( 'p7201010' ) );
	}

	public function testSetAndGetDataType() {
		$propertyId = new PropertyId( 'p7201010' );

		$stringTypeId = 'string-datatype';
		$intTypeId = 'integer';

		$lookup = new InMemoryDataTypeLookup();
		$lookup->setDataTypeForProperty( $propertyId, $stringTypeId );

		$actual = $lookup->getDataTypeIdForProperty( $propertyId );

		$this->assertInternalType( 'string', $actual );

		$this->assertEquals( $stringTypeId, $actual );

		$lookup->setDataTypeForProperty( $propertyId, $intTypeId );

		$actual = $lookup->getDataTypeIdForProperty( $propertyId );

		$this->assertNotEquals( $stringTypeId, $actual );
		$this->assertEquals( $intTypeId, $actual );
	}

}
