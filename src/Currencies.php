<?php
declare(strict_types=1);

namespace Bassix\Finance;

class Currencies
{
    /**
     * Use this to express no currency.
     */
    const NONE = self::CODE_XXX;

    /**
     * Use this in all test cases.
     */
    const TEST = self::CODE_XTS;

    // Built from http://en.wikipedia.org/wiki/ISO_4217.

    /**
     * United Arab Emirates dirham
     */
    const CODE_AED = 'AED';

    /**
     * Afghan afghani
     */
    const CODE_AFN = 'AFN';

    /**
     * Albanian lek
     */
    const CODE_ALL = 'ALL';

    /**
     * Armenian dram
     */
    const CODE_AMD = 'AMD';

    /**
     * Netherlands Antillean guilder
     */
    const CODE_ANG = 'ANG';

    /**
     * Angolan kwanza
     */
    const CODE_AOA = 'AOA';

    /**
     * Argentine peso
     */
    const CODE_ARS = 'ARS';

    /**
     * Australian dollar
     */
    const CODE_AUD = 'AUD';

    /**
     * Aruban florin
     */
    const CODE_AWG = 'AWG';

    /**
     * Azerbaijani manat
     */
    const CODE_AZN = 'AZN';

    /**
     * Bosnia and Herzegovina convertible mark
     */
    const CODE_BAM = 'BAM';

    /**
     * Barbados dollar
     */
    const CODE_BBD = 'BBD';

    /**
     * Bangladeshi taka
     */
    const CODE_BDT = 'BDT';

    /**
     * Bulgarian lev
     */
    const CODE_BGN = 'BGN';

    /**
     * Bahraini dinar
     */
    const CODE_BHD = 'BHD';

    /**
     * Burundian franc
     */
    const CODE_BIF = 'BIF';

    /**
     * Bermudian dollar (customarily known as Bermuda dollar)
     */
    const CODE_BMD = 'BMD';

    /**
     * Brunei dollar
     */
    const CODE_BND = 'BND';

    /**
     * Boliviano
     */
    const CODE_BOB = 'BOB';

    /**
     * Bolivian Mvdol (funds code)
     */
    const CODE_BOV = 'BOV';

    /**
     * Brazilian real
     */
    const CODE_BRL = 'BRL';

    /**
     * Bahamian dollar
     */
    const CODE_BSD = 'BSD';

    /**
     * Bhutanese ngultrum
     */
    const CODE_BTN = 'BTN';

    /**
     * Botswana pula
     */
    const CODE_BWP = 'BWP';

    /**
     * Belarusian ruble
     */
    const CODE_BYR = 'BYR';

    /**
     * Belize dollar
     */
    const CODE_BZD = 'BZD';

    /**
     * Canadian dollar
     */
    const CODE_CAD = 'CAD';

    /**
     * Congolese franc
     */
    const CODE_CDF = 'CDF';

    /**
     * WIR Euro (complementary currency)
     */
    const CODE_CHE = 'CHE';

    /**
     * Swiss franc
     */
    const CODE_CHF = 'CHF';

    /**
     * WIR Franc (complementary currency)
     */
    const CODE_CHW = 'CHW';

    /**
     * Unidad de Fomento (funds code)
     */
    const CODE_CLF = 'CLF';

    /**
     * Chilean peso
     */
    const CODE_CLP = 'CLP';

    /**
     * Chinese yuan
     */
    const CODE_CNY = 'CNY';

    /**
     * Colombian peso
     */
    const CODE_COP = 'COP';

    /**
     * Unidad de Valor Real
     */
    const CODE_COU = 'COU';

    /**
     * Costa Rican colon
     */
    const CODE_CRC = 'CRC';

    /**
     * Cuban convertible peso
     */
    const CODE_CUC = 'CUC';

    /**
     * Cuban peso
     */
    const CODE_CUP = 'CUP';

    /**
     * Cape Verde escudo
     */
    const CODE_CVE = 'CVE';

    /**
     * Czech koruna
     */
    const CODE_CZK = 'CZK';

    /**
     * Djiboutian franc
     */
    const CODE_DJF = 'DJF';

    /**
     * Danish krone
     */
    const CODE_DKK = 'DKK';

    /**
     * Dominican peso
     */
    const CODE_DOP = 'DOP';

    /**
     * Algerian dinar
     */
    const CODE_DZD = 'DZD';

    /**
     * Egyptian pound
     */
    const CODE_EGP = 'EGP';

    /**
     * Eritrean nakfa
     */
    const CODE_ERN = 'ERN';

    /**
     * Ethiopian birr
     */
    const CODE_ETB = 'ETB';

    /**
     * Euro
     */
    const CODE_EUR = 'EUR';

    /**
     * Fiji dollar
     */
    const CODE_FJD = 'FJD';

    /**
     * Falkland Islands pound
     */
    const CODE_FKP = 'FKP';

    /**
     * Pound sterling
     */
    const CODE_GBP = 'GBP';

    /**
     * Georgian lari
     */
    const CODE_GEL = 'GEL';

    /**
     * Ghanaian cedi
     */
    const CODE_GHS = 'GHS';

    /**
     * Gibraltar pound
     */
    const CODE_GIP = 'GIP';

    /**
     * Gambian dalasi
     */
    const CODE_GMD = 'GMD';

    /**
     * Guinean franc
     */
    const CODE_GNF = 'GNF';

    /**
     * Guatemalan quetzal
     */
    const CODE_GTQ = 'GTQ';

    /**
     * Guyanese dollar
     */
    const CODE_GYD = 'GYD';

    /**
     * Hong Kong dollar
     */
    const CODE_HKD = 'HKD';

    /**
     * Honduran lempira
     */
    const CODE_HNL = 'HNL';

    /**
     * Croatian kuna
     */
    const CODE_HRK = 'HRK';

    /**
     * Haitian gourde
     */
    const CODE_HTG = 'HTG';

    /**
     * Hungarian forint
     */
    const CODE_HUF = 'HUF';

    /**
     * Indonesian rupiah
     */
    const CODE_IDR = 'IDR';

    /**
     * Israeli new sheqel
     */
    const CODE_ILS = 'ILS';

    /**
     * Indian rupee
     */
    const CODE_INR = 'INR';

    /**
     * Iraqi dinar
     */
    const CODE_IQD = 'IQD';

    /**
     * Iranian rial
     */
    const CODE_IRR = 'IRR';

    /**
     * Icelandic króna
     */
    const CODE_ISK = 'ISK';

    /**
     * Jamaican dollar
     */
    const CODE_JMD = 'JMD';

    /**
     * Jordanian dinar
     */
    const CODE_JOD = 'JOD';

    /**
     * Japanese yen
     */
    const CODE_JPY = 'JPY';

    /**
     * Kenyan shilling
     */
    const CODE_KES = 'KES';

    /**
     * Kyrgyzstani som
     */
    const CODE_KGS = 'KGS';

    /**
     * Cambodian riel
     */
    const CODE_KHR = 'KHR';

    /**
     * Comoro franc
     */
    const CODE_KMF = 'KMF';

    /**
     * North Korean won
     */
    const CODE_KPW = 'KPW';

    /**
     * South Korean won
     */
    const CODE_KRW = 'KRW';

    /**
     * Kuwaiti dinar
     */
    const CODE_KWD = 'KWD';

    /**
     * Cayman Islands dollar
     */
    const CODE_KYD = 'KYD';

    /**
     * Kazakhstani tenge
     */
    const CODE_KZT = 'KZT';

    /**
     * Lao kip
     */
    const CODE_LAK = 'LAK';

    /**
     * Lebanese pound
     */
    const CODE_LBP = 'LBP';

    /**
     * Sri Lankan rupee
     */
    const CODE_LKR = 'LKR';

    /**
     * Liberian dollar
     */
    const CODE_LRD = 'LRD';

    /**
     * Lesotho loti
     */
    const CODE_LSL = 'LSL';

    /**
     * Lithuanian litas
     */
    const CODE_LTL = 'LTL';

    /**
     * Latvian lats
     */
    const CODE_LVL = 'LVL';

    /**
     * Libyan dinar
     */
    const CODE_LYD = 'LYD';

    /**
     * Moroccan dirham
     */
    const CODE_MAD = 'MAD';

    /**
     * Moldovan leu
     */
    const CODE_MDL = 'MDL';

    /**
     * Malagasy ariary
     */
    const CODE_MGA = 'MGA';

    /**
     * Macedonian denar
     */
    const CODE_MKD = 'MKD';

    /**
     * Myanma kyat
     */
    const CODE_MMK = 'MMK';

    /**
     * Mongolian tugrik
     */
    const CODE_MNT = 'MNT';

    /**
     * Macanese pataca
     */
    const CODE_MOP = 'MOP';

    /**
     * Mauritanian ouguiya
     */
    const CODE_MRO = 'MRO';

    /**
     * Mauritian rupee
     */
    const CODE_MUR = 'MUR';

    /**
     * Maldivian rufiyaa
     */
    const CODE_MVR = 'MVR';

    /**
     * Malawian kwacha
     */
    const CODE_MWK = 'MWK';

    /**
     * Mexican peso
     */
    const CODE_MXN = 'MXN';

    /**
     * Mexican Unidad de Inversion (UDI) (funds code)
     */
    const CODE_MXV = 'MXV';

    /**
     * Malaysian ringgit
     */
    const CODE_MYR = 'MYR';

    /**
     * Mozambican metical
     */
    const CODE_MZN = 'MZN';

    /**
     * Namibian dollar
     */
    const CODE_NAD = 'NAD';

    /**
     * Nigerian naira
     */
    const CODE_NGN = 'NGN';

    /**
     * Nicaraguan córdoba
     */
    const CODE_NIO = 'NIO';

    /**
     * Norwegian krone
     */
    const CODE_NOK = 'NOK';

    /**
     * Nepalese rupee
     */
    const CODE_NPR = 'NPR';

    /**
     * New Zealand dollar
     */
    const CODE_NZD = 'NZD';

    /**
     * Omani rial
     */
    const CODE_OMR = 'OMR';

    /**
     * Panamanian balboa
     */
    const CODE_PAB = 'PAB';

    /**
     * Peruvian nuevo sol
     */
    const CODE_PEN = 'PEN';

    /**
     * Papua New Guinean kina
     */
    const CODE_PGK = 'PGK';

    /**
     * Philippine peso
     */
    const CODE_PHP = 'PHP';

    /**
     * Pakistani rupee
     */
    const CODE_PKR = 'PKR';

    /**
     * Polish złoty
     */
    const CODE_PLN = 'PLN';

    /**
     * Paraguayan guaraní
     */
    const CODE_PYG = 'PYG';

    /**
     * Qatari riyal
     */
    const CODE_QAR = 'QAR';

    /**
     * Romanian new leu
     */
    const CODE_RON = 'RON';

    /**
     * Serbian dinar
     */
    const CODE_RSD = 'RSD';

    /**
     * Russian rouble
     */
    const CODE_RUB = 'RUB';

    /**
     * Rwandan franc
     */
    const CODE_RWF = 'RWF';

    /**
     * Saudi riyal
     */
    const CODE_SAR = 'SAR';

    /**
     * Solomon Islands dollar
     */
    const CODE_SBD = 'SBD';

    /**
     * Seychelles rupee
     */
    const CODE_SCR = 'SCR';

    /**
     * Sudanese pound
     */
    const CODE_SDG = 'SDG';

    /**
     * Swedish krona/kronor
     */
    const CODE_SEK = 'SEK';

    /**
     * Singapore dollar
     */
    const CODE_SGD = 'SGD';

    /**
     * Saint Helena pound
     */
    const CODE_SHP = 'SHP';

    /**
     * Sierra Leonean leone
     */
    const CODE_SLL = 'SLL';

    /**
     * Somali shilling
     */
    const CODE_SOS = 'SOS';

    /**
     * Surinamese dollar
     */
    const CODE_SRD = 'SRD';

    /**
     * South Sudanese pound
     */
    const CODE_SSP = 'SSP';

    /**
     * São Tomé and Príncipe dobra
     */
    const CODE_STD = 'STD';

    /**
     * Syrian pound
     */
    const CODE_SYP = 'SYP';

    /**
     * Swazi lilangeni
     */
    const CODE_SZL = 'SZL';

    /**
     * Thai baht
     */
    const CODE_THB = 'THB';

    /**
     * Tajikistani somoni
     */
    const CODE_TJS = 'TJS';

    /**
     * Turkmenistani manat
     */
    const CODE_TMT = 'TMT';

    /**
     * Tunisian dinar
     */
    const CODE_TND = 'TND';

    /**
     * Tongan paʻanga
     */
    const CODE_TOP = 'TOP';

    /**
     * Turkish lira
     */
    const CODE_TRY = 'TRY';

    /**
     * Trinidad and Tobago dollar
     */
    const CODE_TTD = 'TTD';

    /**
     * New Taiwan dollar
     */
    const CODE_TWD = 'TWD';

    /**
     * Tanzanian shilling
     */
    const CODE_TZS = 'TZS';

    /**
     * Ukrainian hryvnia
     */
    const CODE_UAH = 'UAH';

    /**
     * Ugandan shilling
     */
    const CODE_UGX = 'UGX';

    /**
     * United States dollar
     */
    const CODE_USD = 'USD';

    /**
     * United States dollar (next day) (funds code)
     */
    const CODE_USN = 'USN';

    /**
     * United States dollar (same day) (funds code) (one source[who?] claims it is no longer used, but it is still on the ISO 4217-MA list)
     */
    const CODE_USS = 'USS';

    /**
     * Uruguay Peso en Unidades Indexadas (URUIURUI) (funds code)
     */
    const CODE_UYI = 'UYI';

    /**
     * Uruguayan peso
     */
    const CODE_UYU = 'UYU';

    /**
     * Uzbekistan som
     */
    const CODE_UZS = 'UZS';

    /**
     * Venezuelan bolívar fuerte
     */
    const CODE_VEF = 'VEF';

    /**
     * Vietnamese đồng
     */
    const CODE_VND = 'VND';

    /**
     * Vanuatu vatu
     */
    const CODE_VUV = 'VUV';

    /**
     * Samoan tala
     */
    const CODE_WST = 'WST';

    /**
     * CFA franc BEAC
     */
    const CODE_XAF = 'XAF';

    /**
     * Silver (one troy ounce)
     */
    const CODE_XAG = 'XAG';

    /**
     * Gold (one troy ounce)
     */
    const CODE_XAU = 'XAU';

    /**
     * European Composite Unit (EURCO) (bond market unit)
     */
    const CODE_XBA = 'XBA';

    /**
     * European Monetary Unit (E.M.U.-6) (bond market unit)
     */
    const CODE_XBB = 'XBB';

    /**
     * European Unit of Account 9 (E.U.A.-9) (bond market unit)
     */
    const CODE_XBC = 'XBC';

    /**
     * European Unit of Account 17 (E.U.A.-17) (bond market unit)
     */
    const CODE_XBD = 'XBD';

    /**
     * East Caribbean dollar
     */
    const CODE_XCD = 'XCD';

    /**
     * Special drawing rights
     */
    const CODE_XDR = 'XDR';

    /**
     * UIC franc (special settlement currency)
     */
    const CODE_XFU = 'XFU';

    /**
     * CFA Franc BCEAO
     */
    const CODE_XOF = 'XOF';

    /**
     * Palladium (one troy ounce)
     */
    const CODE_XPD = 'XPD';

    /**
     * CFP franc
     */
    const CODE_XPF = 'XPF';

    /**
     * Platinum (one troy ounce)
     */
    const CODE_XPT = 'XPT';

    /**
     * Code reserved for testing purposes
     */
    const CODE_XTS = 'XTS';

    /**
     * No currency
     */
    const CODE_XXX = 'XXX';

    /**
     * Yemeni rial
     */
    const CODE_YER = 'YER';

    /**
     * South African rand
     */
    const CODE_ZAR = 'ZAR';

    /**
     * Zambian kwacha
     */
    const CODE_ZMK = 'ZMK';

    /**
     * Zimbabwe dollar
     */
    const CODE_ZWL = 'ZWL';

    /**
     * Guernsey pound
     */
    const WITHOUT_CURRENCY_CODE_GGP = 'GGP';

    /**
     * Jersey pound
     */
    const WITHOUT_CURRENCY_CODE_JEP = 'JEP';

    /**
     * Isle of Man pound also Manx pound
     */
    const WITHOUT_CURRENCY_CODE_IMP = 'IMP';

    /**
     * Kiribati dollar
     */
    const WITHOUT_CURRENCY_CODE_KRI = 'KRI';

    /**
     * Somaliland shilling
     */
    const WITHOUT_CURRENCY_CODE_SLS = 'SLS';

    /**
     * Transnistrian ruble
     */
    const WITHOUT_CURRENCY_CODE_PRB = 'PRB';

    /**
     * Tuvalu dollar
     */
    const WITHOUT_CURRENCY_CODE_TVD = 'TVD';

    /**
     * Bitcoin
     */
    const UNOFFICIAL_BTC = 'BTC';

    /**
     * Andorran franc (1:1 peg to the French franc)
     */
    const HISTORICAL_ADF = 'ADF';

    /**
     * Andorran peseta (1:1 peg to the Spanish peseta)
     */
    const HISTORICAL_ADP = 'ADP';

    /**
     * Austrian schilling
     */
    const HISTORICAL_ATS = 'ATS';

    /**
     * Belgian franc (currency union with LUF)
     */
    const HISTORICAL_BEF = 'BEF';

    /**
     * Cypriot pound
     */
    const HISTORICAL_CYP = 'CYP';

    /**
     * German mark
     */
    const HISTORICAL_DEM = 'DEM';

    /**
     * Estonian kroon
     */
    const HISTORICAL_EEK = 'EEK';

    /**
     * Spanish peseta
     */
    const HISTORICAL_ESP = 'ESP';

    /**
     * Finnish markka
     */
    const HISTORICAL_FIM = 'FIM';

    /**
     * French franc
     */
    const HISTORICAL_FRF = 'FRF';

    /**
     * Greek drachma
     */
    const HISTORICAL_GRD = 'GRD';

    /**
     * Irish pound (punt in Irish language)
     */
    const HISTORICAL_IEP = 'IEP';

    /**
     * Italian lira
     */
    const HISTORICAL_ITL = 'ITL';

    /**
     * Luxembourg franc (currency union with BEF)
     */
    const HISTORICAL_LUF = 'LUF';

    /**
     * Monegasque franc (currency union with FRF)
     */
    const HISTORICAL_MCF = 'MCF';

    /**
     * Moroccan franc
     */
    const HISTORICAL_MAF = 'MAF';

    /**
     * Maltese lira
     */
    const HISTORICAL_MTL = 'MTL';

    /**
     * Netherlands guilder
     */
    const HISTORICAL_NLG = 'NLG';

    /**
     * Portuguese escudo
     */
    const HISTORICAL_PTE = 'PTE';

    /**
     * Slovenian tolar
     */
    const HISTORICAL_SIT = 'SIT';

    /**
     * Slovak koruna
     */
    const HISTORICAL_SKK = 'SKK';

    /**
     * San Marinese lira (currency union with ITL and VAL)
     */
    const HISTORICAL_SML = 'SML';

    /**
     * Vatican lira (currency union with ITL and SML)
     */
    const HISTORICAL_VAL = 'VAL';

    /**
     * European Currency Unit (1 XEU = 1 EUR)
     */
    const HISTORICAL_XEU = 'XEU';

    /**
     * Afghan afghani
     */
    const HISTORICAL_AFA = 'AFA';

    /**
     * Angolan new kwanza
     */
    const HISTORICAL_AON = 'AON';

    /**
     * Angolan kwanza readjustado
     */
    const HISTORICAL_AOR = 'AOR';

    /**
     * Argentine peso ley
     */
    const HISTORICAL_ARL = 'ARL';

    /**
     * Argentine peso argentino
     */
    const HISTORICAL_ARP = 'ARP';

    /**
     * Argentine austral
     */
    const HISTORICAL_ARA = 'ARA';

    /**
     * Azerbaijani manat
     */
    const HISTORICAL_AZM = 'AZM';

    /**
     * Bulgarian lev A/99
     */
    const HISTORICAL_BGL = 'BGL';

    /**
     * Bolivian peso
     */
    const HISTORICAL_BOP = 'BOP';

    /**
     * Brazilian cruzeiro novo
     */
    const HISTORICAL_BRB = 'BRB';

    /**
     * Brazilian cruzado
     */
    const HISTORICAL_BRC = 'BRC';

    /**
     * Brazilian cruzeiro
     */
    const HISTORICAL_BRE = 'BRE';

    /**
     * Brazilian cruzado novo
     */
    const HISTORICAL_BRN = 'BRN';

    /**
     * Brazilian cruzeiro real
     */
    const HISTORICAL_BRR = 'BRR';

    /**
     * Chilean escudo
     */
    const HISTORICAL_CLE = 'CLE';

    /**
     * Serbian dinar
     */
    const HISTORICAL_CSD = 'CSD';

    /**
     * Czechoslovak koruna
     */
    const HISTORICAL_CSK = 'CSK';

    /**
     * East German Mark of the GDR (East Germany)
     */
    const HISTORICAL_DDM = 'DDM';

    /**
     * Ecuadorian sucre
     */
    const HISTORICAL_ECS = 'ECS';

    /**
     * Ecuador Unidad de Valor Constante (funds code) (discontinued)
     */
    const HISTORICAL_ECV = 'ECV';

    /**
     * Equatorial Guinean ekwele
     */
    const HISTORICAL_GQE = 'GQE';

    /**
     * Spanish peseta (account A)
     */
    const HISTORICAL_ESA = 'ESA';

    /**
     * Spanish peseta (account B)
     */
    const HISTORICAL_ESB = 'ESB';

    /**
     * Guinean syli
     */
    const HISTORICAL_GNE = 'GNE';

    /**
     * Ghanaian cedi
     */
    const HISTORICAL_GHC = 'GHC';

    /**
     * Guinea-Bissau peso
     */
    const HISTORICAL_GWP = 'GWP';

    /**
     * Israeli lira
     */
    const HISTORICAL_ILP = 'ILP';

    /**
     * Israeli shekel
     */
    const HISTORICAL_ILR = 'ILR';

    /**
     * Icelandic old krona
     */
    const HISTORICAL_ISJ = 'ISJ';

    /**
     * Lao kip
     */
    const HISTORICAL_LAJ = 'LAJ';

    /**
     * Malagasy franc
     */
    const HISTORICAL_MGF = 'MGF';

    /**
     * Old Macedonian denar A/93
     */
    const HISTORICAL_MKN = 'MKN';

    /**
     * Mali franc
     */
    const HISTORICAL_MLF = 'MLF';

    /**
     * Maldivian rupee
     */
    const HISTORICAL_MVQ = 'MVQ';

    /**
     * Mexican peso
     */
    const HISTORICAL_MXP = 'MXP';

    /**
     * Mozambican metical
     */
    const HISTORICAL_MZM = 'MZM';

    /**
     * Newfoundland dollar
     */
    const HISTORICAL_NFD = 'NFD';

    /**
     * Peruvian sol
     */
    const HISTORICAL_PEH = 'PEH';

    /**
     * Peruvian inti
     */
    const HISTORICAL_PEI = 'PEI';

    /**
     * Polish zloty A/94
     */
    const HISTORICAL_PLZ = 'PLZ';

    /**
     * Romanian leu A/05
     */
    const HISTORICAL_ROL = 'ROL';

    /**
     * Russian rouble A/97
     */
    const HISTORICAL_RUR = 'RUR';

    /**
     * Sudanese dinar
     */
    const HISTORICAL_SDD = 'SDD';

    /**
     * Sudanese old pound
     */
    const HISTORICAL_SDP = 'SDP';

    /**
     * Suriname guilder
     */
    const HISTORICAL_SRG = 'SRG';

    /**
     * Soviet Union rouble
     */
    const HISTORICAL_SUR = 'SUR';

    /**
     * Salvadoran colón
     */
    const HISTORICAL_SVC = 'SVC';

    /**
     * Tajikistani ruble
     */
    const HISTORICAL_TJR = 'TJR';

    /**
     * Turkmenistani manat
     */
    const HISTORICAL_TMM = 'TMM';

    /**
     * Turkish lira A/05
     */
    const HISTORICAL_TRL = 'TRL';

    /**
     * Ukrainian karbovanets
     */
    const HISTORICAL_UAK = 'UAK';

    /**
     * Ugandan shilling A/87
     */
    const HISTORICAL_UGS = 'UGS';

    /**
     * Uruguay old peso
     */
    const HISTORICAL_UYN = 'UYN';

    /**
     * Venezuelan bolívar
     */
    const HISTORICAL_VEB = 'VEB';

    /**
     * Gold franc (special settlement currency)
     */
    const HISTORICAL_XFO = 'XFO';

    /**
     * South Yemeni dinar
     */
    const HISTORICAL_YDD = 'YDD';

    /**
     * Yugoslav dinar
     */
    const HISTORICAL_YUD = 'YUD';

    /**
     * Yugoslav dinar
     */
    const HISTORICAL_YUN = 'YUN';

    /**
     * Yugoslav dinar
     */
    const HISTORICAL_YUR = 'YUR';

    /**
     * Yugoslav dinar
     */
    const HISTORICAL_YUO = 'YUO';

    /**
     * Yugoslav dinar
     */
    const HISTORICAL_YUG = 'YUG';

    /**
     * Yugoslav dinar
     */
    const HISTORICAL_YUM = 'YUM';

    /**
     * South African financial rand (funds code) (discontinued)
     */
    const HISTORICAL_ZAL = 'ZAL';

    /**
     * Zaïrean new zaïre
     */
    const HISTORICAL_ZRN = 'ZRN';

    /**
     * Zaïrean zaïre
     */
    const HISTORICAL_ZRZ = 'ZRZ';

    /**
     * Rhodesian dollar
     */
    const HISTORICAL_ZWC = 'ZWC';

    /**
     * Zimbabwean dollar A/06
     */
    const HISTORICAL_ZWD = 'ZWD';

    /**
     * Zimbabwean dollar A/08
     */
    const HISTORICAL_ZWN = 'ZWN';

    /**
     * Zimbabwean dollar A/09
     */
    const HISTORICAL_ZWR = 'ZWR';
}
