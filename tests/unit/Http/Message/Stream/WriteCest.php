<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Unit\Http\Message\Stream;

use Phalcon\Http\Message\Exception;
use Phalcon\Http\Message\Stream;
use UnitTester;

/**
 * Class WriteCest
 */
class WriteCest
{
    /**
     * Tests Phalcon\Http\Message\Stream :: write()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2019-02-10
     */
    public function httpMessageStreamWrite(UnitTester $I)
    {
        $I->wantToTest('Http\Message\Stream - write()');
        $fileName = $I->getNewFileName();
        $fileName = logsDir($fileName);
        $stream   = new Stream($fileName, 'wb');

        $source   = 'A well regulated Militia, being necessary to the security of a free State, '
            . 'the right of the people to keep and bear Arms, shall not be infringed.';
        $expected = strlen($source);
        $actual   = $stream->write($source);
        $I->assertEquals($expected, $actual);

        $stream->close();

        $stream   = new Stream($fileName, 'rb');
        $expected = $source;
        $actual   = $stream->getContents();
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests Phalcon\Http\Message\Stream :: write() - detached
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2019-02-10
     */
    public function httpMessageStreamWriteDetached(UnitTester $I)
    {
        $I->wantToTest('Http\Message\Stream - write() - detached');
        $I->expectThrowable(
            new Exception(
                'A valid resource is required.'
            ),
            function () use ($I) {
                $fileName = $I->getNewFileName();
                $fileName = logsDir($fileName);
                $stream   = new Stream($fileName, 'wb');
                $stream->detach();

                $stream->write("abc");
            }
        );
    }
}
