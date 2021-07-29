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
 */
namespace Sammy\Packs {
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!class_exists ('Sammy\Packs\NCrypt')){
  /**
   * @class NCrypt
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
  class NCrypt extends NCrypt\Base {
    /**
     * @method void setCost
     *
     */
    public function setCost ($cost = null) {
      if (empty ($cost)) {

        $this->cost = self::DEFAULT_COST_VALUE;

      } else {

        $cost = ((int)($cost));

        if($cost >= 4 && $cost <= 31){
          $cost = ($cost < 10) ? ('0' . $cost) : ('' . $cost);
        }else{
          $this->cost = self::DEFAULT_COST_VALUE;
        }

        $this->cost = $cost;

      }
    }

    public function getCost () {
      if (empty ($this->cost)) {
        $this->setCost ();
      }

      return $this->cost;
    }

    public function setHashType ($hashType = null) {
      $this->hashType = (empty($hashType)) ? self::DEFAULT_HASH_TYPE : $hashType;
    }

    public function getHashType () {
      if (empty ($this->hashType)) {
        $this->setHashType ();
      }

      return $this->hashType;
    }

    public function hash ($pass = null) {
      if (!empty ($pass)) {
        $tokens = requires ('sami-tokens');
        $s = $tokens->token (22);
        if (preg_match("/[a-zA-Z0-9\.]/i", $s)) {
          $str_salt = ((string)('$' . $this->getHashType () . '$' . $this->getCost () . '$' . $s . '$'));
          return crypt ($pass, $str_salt);
        }
      }
      return null;
    }

    public function equal_hash ($pass = null, $hash = null) {
      return ((!empty($pass) && !empty($hash)) && (crypt($pass, $hash) == $hash)) ? true : false;
    }

    public function match_hash () {
      return call_user_func_array([$this, 'equal_hash'], func_get_args());
    }

    public function encrypt ($pass = null) {
      return $this->hash ($pass);
    }

    public function ncrypt ($pass = null) {
      return $this->hash ($pass);
    }
  }}
}
