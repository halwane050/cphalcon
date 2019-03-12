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

namespace Phalcon\Test\Unit\Http\Message\Request;

use Phalcon\Http\Message\Request;
use Phalcon\Http\Message\Uri;
use UnitTester;

/**
 * Class GetUriCest
 */
class GetUriCest
{
    /**
     * Tests Phalcon\Http\Message\Request :: getUri()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2019-02-10
     */
    public function httpMessageRequestGetUri(UnitTester $I)
    {
        $I->wantToTest('Http\Message\Request - getUri()');
        $query   = 'https://phalcon:secret@dev.phalcon.ld:8080/action?param=value#frag';
        $uri     = new Uri($query);
        $request = new Request('GET', $uri);

        $expected = $uri;
        $actual   = $request->getUri();
        $I->assertEquals($expected, $actual);
    }
}
