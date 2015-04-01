<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem.captcha
 */

class Captcha {

	public function get_rnd_iv ( $iv_len ) {
			$iv = '';
			while ( $iv_len-- > 0 ) {
					$iv .= chr ( mt_rand ( ) & 0xFF );
			}
			return $iv;
	}
	
	
	public function md5_encrypt ( $plain_text, $password = PASSWORD, $iv_len = 16 ) {
			$plain_text .= "\x13";
			$n = strlen ( $plain_text );
			if ( $n % 16 ) $plain_text .= str_repeat ( "\0", 16 - ( $n % 16 ) );
			$i = 0;
			$enc_text = $this->get_rnd_iv ( $iv_len );
			$iv = substr ( $password ^ $enc_text, 0, 512 );
			while ( $i < $n ) {
					$block = substr ( $plain_text, $i, 16 ) ^ pack ( 'H*', md5 ( $iv ) );
					$enc_text .= $block;
					$iv = substr ( $block . $iv, 0, 512 ) ^ $password;
					$i += 16;
			}
			return base64_encode ( $enc_text );
	}
	
	
	public function md5_decrypt ( $enc_text, $password = PASSWORD, $iv_len = 16 ) {
			$enc_text = base64_decode ( $enc_text );
			$n = strlen ( $enc_text );
			$i = $iv_len;
			$plain_text = '';
			$iv = substr ( $password ^ substr ( $enc_text, 0, $iv_len ), 0, 512 );
			while ( $i < $n ) {
					$block = substr ( $enc_text, $i, 16 );
					$plain_text .= $block ^ pack ( 'H*', md5 ( $iv ) );
					$iv = substr ( $block . $iv, 0, 512 ) ^ $password;
					$i += 16;
			}
			return preg_replace ( '/\\x13\\x00*$/', '', $plain_text );
	}
	
	
	public function rnd_string () {
		$string_array = array('OHE4','KJOA','A3L6','H5VS','2YNB','9Q8F','RMO7','PDID','VXHF','G6QQ','9BXR','HSKJ','R7V0','X4GO','Q4WF','IESD','BASS','GIJQ','UGHB','91V0','8Q15','UHUL','LQ04','5SHH','3A9J','TS9O','8RZI','SVI1','MK7H','222N','T2SY','VAFY','KPHE','HR2Q','J18B','XRDJ','CL0E','N22G','5UF0','4UYO','KG21','85SR','6134','SHN4','2OJP','QL6W','FLWJ','GV80','BB2K','GUBN','VESO','VFTY','3CNU','XUQD','FNXW','I6XU','HZEY','UQMP','5EE1','U8ZY','KNTI','HKVX','8STQ','YQLG','Q0FK','Q2AW','HOXB','WWAH','J3Z0','OUXW','NRNM','I828','9HS0','K2W1','QTCN','QN49','R4AF','Y8BM','0Z8I','8AQH','SIHD','LEEC','8RZY','E485','8IL7','RXUR','W294','D0M6','J3J4','IXGQ','OGO3','KW9T','FU16','RVXN','Y7SB','7EIQ','I1V0','ZBQN','RFRC','B06R','U8XM','3VA2','32DA','HV1Z','XWZW','8QK0','5BDH','CJ86','R5SV','12X4','5BFM','7GM4','DM1L','CLLI','XYZ9','I7FA','D86E','B4JG','GY3N','FPSS','BTDO','EZ6B','Y6KH','D0RR','8Y6J','2P0J','N463','TYV5','R9U6','81H7','72OL','2GCB','FIVI','8V1W','Z7ZT','6UZX','4T3D','VLK2','N9NQ','Q015','JWNR','SOOS','WNL2','IL0M','F3ZA','PKCD','T03J','04OJ','1CBT','0ZLW','M7Z5','SZR8','3QIS','AV54','W9OX','ECGF','PS8P','RUME','1MJU','LA2O','1LHC','HNHD','W5AA','HRP7','JYWB','SJPT','58NR','JQFK','BXXT','KE6H','JHR1','9H8T','G548','PT2V','2QML','G26S','04LK','IS22','AT3J','BCDR','IH07','B33D','TQZA','S53S','9PDS','IFUS','9YCL','BPDT','7E1I','H5VA','VVLN','1PGA','EU3W','AYPJ','X259','SI3Z','W4HD','9DO4','8AS9','Z9KD','3OAD','N0XK','22TU','KWUH','1CVB','PJGY','T98T','IT6M','IH05','HXQK','0KFL','GA2I','MXUC','HAAB','JJ41','DBOV','SO0A','MRVM','BA7S','K9A6','74JO','FTZY','D30Q','EPM7','DNHZ','ECLP','NSH7','2SE9','XXXC','RXB5','0CWF','1IME','63EL','GZA3','SSBV','LQ4I','O2VG','Z7LZ','JHFL','01Z7','5ESL','E3P6','W11H','R60G','8WW8','3I7N','0M80','O88T','M0F0','4570','69HY','GIEO','EBXI','T55T','REUG','M299','3PA7','UI80','SPY8','8DXM','OU4H','ZABR','O57B','7HLB','6VJ0','ER16','H0EP','DBC2','5HK4','RVWG','13S8','KDKR','93RN','USUB','S806','KC8P','TTUL','OQ1P','UUYF','7J6G','MX4G','QYSJ','7SPR','5YHZ','RCLG','3N6X','H5CO','OI5A','GAR6','9JPG','CF8I','DPI5','23L5','QS37','XFWM','Y1XF','COLL','8B1L','Q944','ZM91','PU7G','NANK','QK7P','L44X','TQJ1','1KNS','URWU','E5W4','03KO','E885','SGVE','KZCD','QVFR','G2KA','UH58','N1CN','5WBK','5KPX','0KCL','KOYA','JD2Z','GNAA','4FIR','HUFM','RR7W','CXUD','H6Y2','UXDE','AFER','2O17','4KYL','ED86','4F2H','CWUU','3SXX','PAC0','QQRT','FT0J','DY5S','CDZH','T1Y6','YS11','LZZB','9BB0','13TG','XU0B','T545','J3ND','4MJ3','FL40','K4BU','FNUH','ROYO','IYZB','43GO','641B','QLE6','6J7R','NIL3','6GKX','4JMM','ILXM','PEAW','JC79','XMG4','6NVU','6GYC','XJA1','2WNK','IK78','ZI4I','UCSS','Z8W6','VR01','8YE5','IO7K','LU53','FDBE','VGXQ','SPIR','XEXT','6YUF','X9LF','XS0J','M5N2','JYHE','FE57','3NZ1','2XV9','WQOT','ZA9X','29GP','F3SY','29DH','NIPR','6PT8','MOII','E7CE','HMBK','WSAB','V2AY','BNGZ','65QC','VKLH','840N','BD2T','ZDEV','5O71','QH02','5G1C','MSPH','CBZL','F09R','DBKD','PY9V','MGXD','YXG4','EHH0','A6IN','HI8X','IIOV','U89J','7IFU','YC8X','AO2O','6JPG','P737','PC47','VS3P','1D99','VO3U','0CSB','0UZ6','DON2','WQAM','2EUY','7XN8','BWI6','LM1M','YTXZ','OW61','LT4H','JE3M','SXK0','V896','4RDQ','DECC','89BW','6HYR','A28U','GCH9','9194','9JBE','AP4O','3G0C','QC9W','U7N5','9WZQ','8G0I','IANS','TY63','NBRR','SS4I','5DFZ','L34U','Z3L8','KLQ2','WEUP','D1T1','CLT4','DXNI','B2IW','5MR5','QDEA','Y5DV','J8KW','9DXM','YQRC','OEVZ','HEWM','0NSR','062Z','BFVV','OFRY','TPKS','GC54','Q148','F1VF','PN6Q','U8Q5','OL0C','0SBU','HVMY','8S3Z','T878','92OY','PVOJ','4EPS','ZQ50','IGV0');
		return $string_array[rand(0, 499)];
	}

}
?>