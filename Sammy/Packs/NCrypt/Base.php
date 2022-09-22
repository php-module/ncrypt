<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\NCrypt
 * - Autoload, application dependencies
 *
 * MIT License
 *
 * Copyright (c) 2020 Ysare
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * === NCrypt ===
 *
 * @author Saml
 * @package Sami
 *
 * NCrypt's a php module used to
 * encrypt string datas in basing it's script
 * on the php built-in function and classes
 *
 * It can be used as the crypt, password_hash, md5 and sha1
 * php functions; having a similar efect in the crypted strings
 * and, as SamiOne says, adding something new.
 * there's an argorithim that generates a random token that'll be added
 * at a random position of the given string in order preserving
 * the security in spite of being used an insecure pass or key word.
 *
 * ===================== USE =====================
 *
 * $ncrypt = requires('ncrypt');
 * $str = 'Foo';
 * $crypted = $ncrypt->encrypt($str);
 *
 * ===============================================
 */
namespace Sammy\Packs\NCrypt {
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!class_exists('Sammy\Packs\NCrypt\Base')){
  /**
   * @class Base
   * Base internal class for the
   * NCrypt module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   */
  class Base {
    const DEFAULT_COST_VALUE = '07';
    const DEFAULT_HASH_TYPE = '2a';

    /**
     * @var cost
     * The hashing cost
     * default's {DEFAULT_COST_VALUE}
     */
    protected $cost;

    /**
     * @var hashType
     * Typeof hash being used by
     * SamiCrypt
     */
    protected $hashType;
    protected $alpha_lower = 'abcdefghijklmnopqrstuvwxyz';
    protected $alpha_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected $num = '0123456789';

    public function __construct ($cost = null) {
      $this->setCost ($cost);
    }

    public function __invoke () {
      return call_user_func_array (
        [$this, 'ncrypt'], func_get_args ()
      );
    }

    public function __call ($method_name, $args) {}

    public static function __callStatic ($method_name, $args) {

      $re = '/^e?ncrypt(pass(word)?)$/i';
      if (preg_match ($re, $method_name)) {
        return call_user_func_array (
          [new static, 'ncrypt'], $args
        );
      }
    }
  }}
}
