<?php
function countries_list($current = null, $select_name="country", $others = false){
    $african_countries = array(
		'Algeria', 'Angola', 'Benin', 'Burkina Faso', 'Burundi', 'Cape Verde', 'Cameroon',
		'Central African Republic', 'Chad', 'Congo, Republic of the',
		'Congo, Democratic Republic of the', 'Cote d Ivoire', 'Djibouti', 'Egypt',
		'Equatorial Guinea', 'Eritrea', 'Ethiopia', 'Gabon', 'Gambia', 'Ghana', 'Guinea',
        'Guinea-Bissau', 'Kenya', 'Lesotho', 'Liberia', 'Libya', 'Madagascar', 'Malawi', 'Mali',
        'Malta', 'Mauritania', 'Mauritius', 'Mayotte', 'Morocco', 'Mozambique', 'Namibia', 'Niger',
        'Nigeria', 'Rwanda', 'Reunion', 'Saint Helena', 'Senegal', 'Sierra Leone', 'Somalia', 'South Africa',
        'Sudan', 'Swaziland', 'Tanzania', 'Togo', 'Tunisia', 'Uganda', 'Western Sahara', 'Zambia', 'Zimbabwe'
	);
    $other_countries = array('Afghanistan', 'Albania', 'Andorra', 'Antigua and Barbuda', 'Argentina',
        'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados',
        'Belarus', 'Belgium', 'Belize', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana',
        'Brazil', 'Brunei', 'Bulgaria', 'Cambodia', 'Canada', 'Chile', 'China', 'Colombia', 'Comoros',
        'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic',
        'Denmark', 'Dominica', 'Dominican Republic', 'Ecuador', 'El Salvador', 'Estonia', 'Fiji', 'Finland',
        'France', 'Georgia', 'Germany', 'Greece', 'Grenada', 'Guatemala', 'Guyana',
        'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel',
        'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kiribati', 'Kosovo', 'Kuwait', 'Kyrgyzstan',
        'Laos', 'Latvia', 'Lebanon', 'Liechtenstein', 'Lithuania', 'Luxembourg',
        'Macedonia', 'Malaysia', 'Maldives', 'Marshall Islands', 'Mexico', 'Micronesia', 'Moldova', 'Monaco',
        'Mongolia', 'Montenegro', 'Myanmar', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua',
        'North Korea', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua New Guinea', 'Paraguay',
        'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'St. Kitts and Nevis',
        'St. Lucia', 'St. Vincent and The Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia',
        'Serbia', 'Seychelles', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'South Korea', 'Spain',
        'Sri Lanka', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan',
        'Thailand', 'Timor-Leste', 'Tonga', 'Trinidad and Tobago', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Ukraine',
        'United Arab Emirates', 'United Kingdom', 'United States of America', 'Uruguay', 'Uzbekistan', 'Vanuatu',
        'Vatican City State', 'Venezuela', 'Vietnam', 'Yemen', );

    if($others == true){
        $african_countries = array_merge($african_countries, $other_countries);
        sort($african_countries);
    }
	$out = '<select name="'.$select_name.'" class="form-control">';
	foreach($african_countries as $country){
		$sel = (!empty($current) && ($country == $current)) ? 'selected="selected"' : '' ;
		$out .= '<option value="'.$country.'" '.$sel.'>'.$country.'</option>';
	}
	$out .= '</select>';
	return $out;
}
?>
