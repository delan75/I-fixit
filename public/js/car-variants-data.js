/**
 * Car variants/trim levels data
 * Organized by make and model
 */
const carVariantsData = {
    // Ford variants
    'Ford': {
        'Fiesta': [
            '1.0 EcoBoost',
            '1.4',
            '1.4i',
            '1.6 S',
            'Ambiente',
            'Ghia',
            'ST',
            'Titanium',
            'Trend'
        ],
        'Ranger': [
            '2.0 BiT',
            '2.0 SiT',
            '2.2 TDCi',
            '3.2 TDCi',
            'Raptor',
            'Wildtrak',
            'XL',
            'XLS',
            'XLT'
        ],
        'EcoSport': [
            '1.0 EcoBoost',
            '1.5 TDCi',
            '1.5 Ti-VCT',
            'Ambiente',
            'Titanium',
            'Trend'
        ],
        'Everest': [
            '2.0 BiT',
            '2.0 SiT',
            '3.2 TDCi',
            'Limited',
            'Titanium',
            'XLT'
        ],
        'Focus': [
            '1.0 EcoBoost',
            '1.5 EcoBoost',
            '2.0 TDCi',
            'Ambiente',
            'ST',
            'Titanium',
            'Trend'
        ]
    },
    
    // Toyota variants
    'Toyota': {
        'Corolla': [
            '1.2T',
            '1.6',
            '1.8',
            '2.0',
            'Ascent',
            'Ascent Sport',
            'GR Sport',
            'Prestige',
            'Quest',
            'SX',
            'XLi',
            'XR',
            'XRS',
            'ZR'
        ],
        'Hilux': [
            '2.0',
            '2.4 GD-6',
            '2.7 VVTi',
            '2.8 GD-6',
            '4.0 V6',
            'Legend',
            'Raider',
            'SR',
            'SRX'
        ],
        'Fortuner': [
            '2.4 GD-6',
            '2.7 VVTi',
            '2.8 GD-6',
            '4.0 V6',
            'Epic',
            'GX',
            'TX',
            'VX'
        ],
        'RAV4': [
            '2.0',
            '2.5',
            '2.5 Hybrid',
            'GX',
            'GX-R',
            'TX',
            'VX'
        ]
    },
    
    // Volkswagen variants
    'Volkswagen': {
        'Golf': [
            '1.0 TSI',
            '1.4 TSI',
            '2.0 TDI',
            '2.0 TSI',
            'Comfortline',
            'GTI',
            'R',
            'Trendline'
        ],
        'Polo': [
            '1.0 TSI',
            '1.2 TSI',
            '1.4 TDI',
            '1.6',
            'Comfortline',
            'GTI',
            'Highline',
            'Trendline',
            'Vivo'
        ],
        'Tiguan': [
            '1.4 TSI',
            '2.0 TDI',
            '2.0 TSI',
            'Allspace',
            'Comfortline',
            'Highline',
            'R-Line',
            'Trendline'
        ]
    },
    
    // Nissan variants
    'Nissan': {
        'Navara': [
            '2.3D',
            '2.5',
            '2.5 dCi',
            '3.0 dCi',
            'LE',
            'Pro-4X',
            'SE',
            'SL',
            'XE'
        ],
        'X-Trail': [
            '1.6 dCi',
            '2.0',
            '2.5',
            'Acenta',
            'SE',
            'Tekna',
            'Visia'
        ]
    },
    
    // Isuzu variants
    'Isuzu': {
        'D-Max': [
            '2.5 TD',
            '3.0 TD',
            'Hi-Ride',
            'LS',
            'LX',
            'X-Rider'
        ],
        'MU-X': [
            '3.0',
            'LS',
            'Onyx'
        ]
    },
    
    // Hyundai variants
    'Hyundai': {
        'Tucson': [
            '1.6 T-GDi',
            '2.0',
            '2.0 CRDi',
            'Elite',
            'Executive',
            'N Line',
            'Premium',
            'Sport'
        ],
        'i20': [
            '1.0 T-GDi',
            '1.2',
            '1.4',
            'Active',
            'Fluid',
            'Glide',
            'Motion',
            'N'
        ]
    }
};

// Helper function to get variants for a specific make and model
function getCarVariants(make, model) {
    if (carVariantsData[make] && carVariantsData[make][model]) {
        return carVariantsData[make][model];
    }
    return [];
}
