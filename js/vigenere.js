/* Implementation of the Vigenere cipher, operating only on ASCII strings.
 *
 * This cipher is not secure. Please don't actually use it.
 * See: http://en.wikipedia.org/wiki/Vigenere_cipher
 *
 * Written by Calvin Owens
 */

function encrypt_string(str, key)
{
	var enc_str = "";
	for (var i = 0; i < str.length; i++) {
		ct_code = (str.charCodeAt(i) + key.charCodeAt(i % key.length));
		while (ct_code >= 127)
			ct_code -= 95;

		enc_str += String.fromCharCode(ct_code);
	}

	return enc_str;
}

function decrypt_string(str, key)
{
	var dec_str = "";
	for (var i = 0; i < str.length; i++) {
		ct_code = str.charCodeAt(i) - key.charCodeAt(i % key.length);
		while (ct_code <= 31)
			ct_code += 95;

		dec_str += String.fromCharCode(ct_code);
	}

	return dec_str;
}
