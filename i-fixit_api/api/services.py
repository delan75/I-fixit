"""
Service layer for the API.
This layer contains business logic and coordinates between repositories.
"""
import logging
from .repositories import CarRepository, PartRepository, OpportunityRepository, UserPreferenceRepository

logger = logging.getLogger(__name__)


class CarService:
    """Service for car-related operations."""

    @staticmethod
    def get_all_cars(filters=None):
        """
        Get all cars with optional filtering.

        Args:
            filters (dict): Optional filters to apply

        Returns:
            QuerySet: Filtered cars
        """
        return CarRepository.get_all_cars(filters)

    @staticmethod
    def get_car_by_id(car_id):
        """
        Get a car by ID.

        Args:
            car_id (int): Car ID

        Returns:
            Car: Car instance or None
        """
        return CarRepository.get_car_by_id(car_id)

    @staticmethod
    def create_car(car_data, user_id):
        """
        Create a new car.

        Args:
            car_data (dict): Car data
            user_id (int): User ID

        Returns:
            Car: Created car instance
        """
        car_data['user_id'] = user_id
        return CarRepository.create_car(car_data)

    @staticmethod
    def update_car(car_id, car_data):
        """
        Update a car.

        Args:
            car_id (int): Car ID
            car_data (dict): Car data

        Returns:
            Car: Updated car instance or None if car not found
        """
        car = CarRepository.get_car_by_id(car_id)
        if not car:
            return None

        return CarRepository.update_car(car, car_data)

    @staticmethod
    def delete_car(car_id):
        """
        Delete a car.

        Args:
            car_id (int): Car ID

        Returns:
            bool: True if deleted, False if car not found
        """
        car = CarRepository.get_car_by_id(car_id)
        if not car:
            return False

        return CarRepository.delete_car(car)

    @staticmethod
    def get_car_financial_summary(car_id):
        """
        Get financial summary for a car.

        Args:
            car_id (int): Car ID

        Returns:
            dict: Financial summary or None if car not found
        """
        car = CarRepository.get_car_by_id(car_id)
        if not car:
            return None

        return CarRepository.get_car_financial_summary(car_id)

    @staticmethod
    def get_parts_by_car_id(car_id):
        """
        Get parts for a specific car.

        Args:
            car_id (int): Car ID

        Returns:
            QuerySet: Parts for the car or None if car not found
        """
        car = CarRepository.get_car_by_id(car_id)
        if not car:
            return None

        return PartRepository.get_parts_by_car_id(car_id)


class OpportunityService:
    """Service for opportunity-related operations."""

    @staticmethod
    def get_all_opportunities(filters=None):
        """
        Get all opportunities with optional filtering.

        Args:
            filters (dict): Optional filters to apply

        Returns:
            QuerySet: Filtered opportunities
        """
        return OpportunityRepository.get_all_opportunities(filters)

    @staticmethod
    def create_opportunity(opportunity_data):
        """
        Create a new opportunity.

        Args:
            opportunity_data (dict): Opportunity data

        Returns:
            Opportunity: Created opportunity instance
        """
        # Calculate opportunity score if not provided
        if 'opportunity_score' not in opportunity_data:
            opportunity_data['opportunity_score'] = OpportunityService._calculate_opportunity_score(opportunity_data)

        return OpportunityRepository.create_opportunity(opportunity_data)

    @staticmethod
    def _calculate_opportunity_score(opportunity_data):
        """
        Calculate opportunity score based on potential profit and other factors.

        This enhanced algorithm considers:
        - Potential profit and ROI
        - Repair cost ratio
        - Vehicle condition (keys, starts, battery, spare wheel)
        - Vehicle age and depreciation curve
        - Vehicle make popularity and resale value
        - Vehicle code (damage history)
        - Auction timing and bidding activity
        - Market demand for specific makes/models

        Args:
            opportunity_data (dict): Opportunity data

        Returns:
            int: Opportunity score (0-100)
        """
        # If opportunity_score is already provided, use it
        if 'opportunity_score' in opportunity_data:
            return opportunity_data['opportunity_score']

        # Base score starts at 50
        score = 50

        # Dictionary to track score components for debugging
        score_components = {
            'base': 50,
            'profit_potential': 0,
            'repair_ratio': 0,
            'vehicle_condition': 0,
            'vehicle_age': 0,
            'make_popularity': 0,
            'vehicle_code': 0,
            'auction_timing': 0,
            'features': 0
        }

        # 1. Financial factors (30% of total weight)
        # --------------------------------------

        # Potential profit assessment
        potential_profit = opportunity_data.get('potential_profit', 0)
        if potential_profit:
            if potential_profit > 70000:  # Exceptional profit potential
                profit_score = 30
            elif potential_profit > 50000:  # High profit potential
                profit_score = 25
            elif potential_profit > 30000:  # Good profit potential
                profit_score = 20
            elif potential_profit > 15000:  # Moderate profit potential
                profit_score = 15
            elif potential_profit > 10000:  # Low profit potential
                profit_score = 10
            else:
                profit_score = 5

            score += profit_score
            score_components['profit_potential'] = profit_score

        # ROI calculation (if we have both cost and market value)
        current_bid = opportunity_data.get('current_bid', 0)
        repair_cost = opportunity_data.get('estimated_repair_cost', 0)
        market_value = opportunity_data.get('estimated_market_value', 0)

        if current_bid and repair_cost and market_value:
            total_investment = current_bid + repair_cost
            if total_investment > 0:
                roi = (market_value - total_investment) / total_investment * 100

                if roi > 50:  # Exceptional ROI
                    score += 15
                    score_components['profit_potential'] += 15
                elif roi > 40:  # Excellent ROI
                    score += 12
                    score_components['profit_potential'] += 12
                elif roi > 30:  # Very good ROI
                    score += 10
                    score_components['profit_potential'] += 10
                elif roi > 20:  # Good ROI
                    score += 7
                    score_components['profit_potential'] += 7
                elif roi > 10:  # Acceptable ROI
                    score += 3
                    score_components['profit_potential'] += 3
                else:  # Poor ROI
                    score -= 5
                    score_components['profit_potential'] -= 5

        # Repair cost ratio assessment
        if repair_cost and market_value:
            repair_ratio = repair_cost / market_value

            if repair_ratio < 0.15:  # Minimal repairs needed
                repair_score = 15
            elif repair_ratio < 0.25:  # Low repair cost relative to value
                repair_score = 10
            elif repair_ratio < 0.40:  # Moderate repair cost
                repair_score = 5
            elif repair_ratio < 0.60:  # High repair cost
                repair_score = -10
            else:  # Very high repair cost
                repair_score = -20

            score += repair_score
            score_components['repair_ratio'] = repair_score

        # 2. Vehicle condition factors (25% of total weight)
        # --------------------------------------

        # Basic condition assessment
        has_keys = opportunity_data.get('has_keys', False)
        has_spare_key = opportunity_data.get('has_spare_key', False)
        vehicle_starts = opportunity_data.get('vehicle_starts', False)
        has_battery = opportunity_data.get('has_battery', False)
        has_spare_wheel = opportunity_data.get('has_spare_wheel', False)

        condition_score = 0

        # Keys and starting condition (most important)
        if has_keys and vehicle_starts:
            condition_score += 15  # Ideal condition
        elif has_keys and not vehicle_starts:
            condition_score += 5   # Has keys but doesn't start
        elif not has_keys and vehicle_starts:
            condition_score -= 5   # Starts but no keys (will need replacement)
        else:
            condition_score -= 15  # No keys and doesn't start (problematic)

        # Spare key is valuable
        if has_spare_key:
            condition_score += 5   # Having a spare key is a significant plus

        # Additional features
        if has_battery:
            condition_score += 3
        if has_spare_wheel:
            condition_score += 2

        score += condition_score
        score_components['vehicle_condition'] = condition_score

        # 3. Vehicle age and depreciation (15% of total weight)
        # --------------------------------------

        year = opportunity_data.get('year', 0)
        if year:
            current_year = 2025  # Update this as needed
            age = current_year - year

            # Age scoring with depreciation curve consideration
            if age <= 1:
                age_score = 15  # Nearly new vehicles (steep depreciation already occurred)
            elif age <= 3:
                age_score = 12  # Very recent models
            elif age <= 5:
                age_score = 10  # Recent models
            elif age <= 7:
                age_score = 8   # Moderately recent
            elif age <= 10:
                age_score = 5   # Middle-aged vehicles
            elif age <= 15:
                age_score = 0   # Older vehicles
            elif age <= 20:
                age_score = -5  # Old vehicles
            else:
                age_score = -10 # Very old vehicles

            score += age_score
            score_components['vehicle_age'] = age_score

        # 4. Make popularity and resale value (15% of total weight)
        # --------------------------------------

        make = opportunity_data.get('make', '').lower()

        # Popular makes with good resale value
        popular_makes = {
            'toyota': 15,      # Excellent reliability and resale
            'honda': 8,       # Excellent reliability and resale
            'volkswagen': 15,  # Good resale in South Africa
            'ford': 14,        # Good popularity
            'hyundai': 12,     # Growing popularity and good warranty
            'kia': 12,         # Growing popularity and good warranty
            'mazda': 9,       # Good reliability
            'nissan': 12,       # Good popularity
            'suzuki': 8,       # Good for small cars
            'bmw': 12,          # Luxury but higher maintenance
            'mercedes': 12,     # Luxury but higher maintenance
            'audi': 11,         # Luxury but higher maintenance
            'renault': 3,      # Moderate popularity
            'opel': 6,         # Moderate popularity
            'chevrolet': 7,    # Moderate popularity
            'peugeot': 3,      # Lower resale value
            'citroen': 2,      # Lower resale value
            'fiat': 2,         # Lower resale value
        }

        make_score = popular_makes.get(make, 0)
        score += make_score
        score_components['make_popularity'] = make_score

        # 5. Vehicle code (damage history) (10% of total weight)
        # --------------------------------------

        vehicle_code = opportunity_data.get('vehicle_code', '0')

        if vehicle_code == '1':  # Code 1 - New Vehicle
            code_score = 10
        elif vehicle_code == '2':  # Code 2 - Used Vehicle
            code_score = 8
        elif vehicle_code == '3':  # Code 3 - Rebuilt Vehicle
            code_score = -5
        elif vehicle_code == '4':  # Code 4 - Permanently Unfit
            code_score = -30  # Major negative impact
        else:  # Unknown
            code_score = 0

        score += code_score
        score_components['vehicle_code'] = code_score

        # 6. Mileage assessment (15% of total weight)
        # --------------------------------------

        # Check for odometer reading (lower mileage is better)
        odometer = opportunity_data.get('odometer', '')
        if odometer:
            try:
                # Try to extract numeric value from odometer string
                numeric_value = ''.join(filter(str.isdigit, str(odometer)))
                if numeric_value:
                    mileage = int(numeric_value)
                    mileage_score = 0

                    # Direct mileage scoring (regardless of age)
                    if mileage < 50000:  # Very low mileage
                        mileage_score += 10
                    elif mileage < 80000:  # Low mileage
                        mileage_score += 8
                    elif mileage < 120000:  # Moderate mileage
                        mileage_score += 5
                    elif mileage < 160000:  # Average mileage
                        mileage_score += 0
                    elif mileage < 200000:  # High mileage
                        mileage_score -= 5
                    else:  # Very high mileage
                        mileage_score -= 10

                    score += mileage_score
                    score_components['features'] = mileage_score

                    # Adjust based on vehicle age to get mileage per year
                    if year and age > 0:
                        annual_mileage = mileage / age
                        annual_score = 0

                        if annual_mileage < 10000:  # Low annual mileage
                            annual_score = 5
                        elif annual_mileage < 15000:  # Average annual mileage
                            annual_score = 3
                        elif annual_mileage < 20000:  # Slightly high annual mileage
                            annual_score = 0
                        elif annual_mileage < 25000:  # High annual mileage
                            annual_score = -3
                        else:  # Very high annual mileage
                            annual_score = -5

                        score += annual_score
                        score_components['features'] += annual_score

                    logger.info(f"Mileage: {mileage}, Score contribution: {score_components['features']}")
            except (ValueError, TypeError) as e:
                # If we can't parse the odometer, ignore this factor
                logger.warning(f"Error parsing odometer value '{odometer}': {str(e)}")
                pass

        # Ensure score is within 0-100 range
        final_score = max(0, min(100, score))

        return final_score


class UserPreferenceService:
    """Service for user preference operations."""

    @staticmethod
    def get_user_preference(user_id):
        """
        Get preferences for a specific user.

        Args:
            user_id (int): User ID

        Returns:
            UserPreference: User preference instance or None
        """
        return UserPreferenceRepository.get_user_preference(user_id)

    @staticmethod
    def create_or_update_preference(user_id, preference_data):
        """
        Create or update user preferences.

        Args:
            user_id (int): User ID
            preference_data (dict): Preference data

        Returns:
            UserPreference: Created or updated user preference instance
        """
        return UserPreferenceRepository.create_or_update_preference(user_id, preference_data)

    @staticmethod
    def match_opportunities_to_preferences(user_id):
        """
        Match opportunities to user preferences.

        Args:
            user_id (int): User ID

        Returns:
            list: Matching opportunities
        """
        preferences = UserPreferenceRepository.get_user_preference(user_id)
        if not preferences:
            return []

        # Start with basic database filters
        filters = {}

        # Basic vehicle preferences
        if preferences.preferred_makes:
            filters['make__in'] = preferences.preferred_makes

        if preferences.preferred_models:
            filters['model__in'] = preferences.preferred_models

        if preferences.min_year:
            filters['year__gte'] = preferences.min_year

        if preferences.max_year:
            filters['year__lte'] = preferences.max_year

        # Financial preferences
        if preferences.min_profit:
            filters['potential_profit__gte'] = preferences.min_profit

        # Vehicle condition preferences
        if preferences.preferred_vehicle_codes:
            filters['vehicle_code__in'] = preferences.preferred_vehicle_codes

        if preferences.require_keys:
            filters['has_keys'] = True

        if preferences.require_spare_key:
            filters['has_spare_key'] = True

        if preferences.require_starts:
            filters['vehicle_starts'] = True

        if preferences.require_battery:
            filters['has_battery'] = True

        if preferences.require_spare_wheel:
            filters['has_spare_wheel'] = True

        # Auction preferences
        if preferences.preferred_sources:
            filters['source__in'] = preferences.preferred_sources

        # Get opportunities matching the database filters
        opportunities = OpportunityRepository.get_all_opportunities(filters)

        # Apply post-database filters that require more complex logic
        filtered_opportunities = []

        for opp in opportunities:
            # Skip if opportunity doesn't meet the investment criteria
            if preferences.max_investment:
                total_investment = (opp.current_bid or 0) + (opp.estimated_repair_cost or 0)
                if total_investment > preferences.max_investment:
                    continue

            # Skip if opportunity doesn't meet the mileage criteria
            if preferences.max_mileage and opp.odometer:
                try:
                    # Try to extract numeric value from odometer string
                    numeric_value = ''.join(filter(str.isdigit, str(opp.odometer)))
                    if numeric_value and int(numeric_value) > preferences.max_mileage:
                        continue
                except (ValueError, TypeError):
                    # If we can't parse the odometer, don't filter based on it
                    pass

            # Skip if opportunity doesn't meet the annual mileage criteria
            if preferences.max_annual_mileage and opp.odometer and opp.year:
                try:
                    numeric_value = ''.join(filter(str.isdigit, str(opp.odometer)))
                    if numeric_value:
                        mileage = int(numeric_value)
                        current_year = 2025  # Update this as needed
                        age = current_year - opp.year
                        if age > 0:
                            annual_mileage = mileage / age
                            if annual_mileage > preferences.max_annual_mileage:
                                continue
                except (ValueError, TypeError):
                    # If we can't calculate annual mileage, don't filter based on it
                    pass

            # If we've made it here, the opportunity meets all criteria
            filtered_opportunities.append(opp)

        return filtered_opportunities
