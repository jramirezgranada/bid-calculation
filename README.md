### System Requirements

1. Docker
2. Local PHP 8 and Composer

### Installation Steps

- Clone this repository
- Create `.env` file: `cp .env.example .env`
- Install dependencies `composer install`
- Generate system key: `php artisan key:generate`
- Install laravel sail: `php artisan sail:install` and enter 0 to install mysql
- Create development environment: `vendor/bin/sail up -d`
- Run migrations and seeders: `vendor/bin/sail artisan migrate:fresh --seed`
- Install front end dependencies: `vendor/bin/sail npm install`
- Compile front end assets: `vendor/bin/sail npm run dev`
- Run `vendor/bin/sail npm run build`
- Run tests `vendor/bin/sail tests`
- Open app in local: `http://localhost`

### Development Notes:

1. Development user:
    * email: `admin@admin.com`
    * password: `password`

### Problem Notes

- The initial max vehicle amount is calculated with this operation `maxAmount = budget - storage_fee`
- After that we need to calculate the MaxTaxedAmount and MinTaxedAmount:
    * The MaxTaxedAmount is calculated with this operation: `(maxAmount - basicMaxFee) / 102 * 100`
    * The MinTaxedAmount is calculated with this operation: `(maxAmount - basicMinFee) / 102 * 100`
    * Note: is calculated base on 102% since the max vehicle amount (100%) + special fee (2%) = 102%

    - We need to calculate the MaxAssociatedCost and MinAssociatedCost finding the data in the association_fees table in
      db:
        * MaxAssociatedCost: `select * from association_fees where amount_from <= MaxTaxedAmount and
          amount_to >= MaxTaxedAmount`
        * MinAssociatedCost: `select * from association_fees where amount_from <= MixTaxedAmount and
          amount_to >= MixTaxedAmount`
- After previous calculation we validate if both objects are empty, if so, then we will return all fees in 0.
- If MaxAssociatedCost is empty then the association cost value will be the value found in the MinAssociatedCost
- Else, we get the value from MaxAssociatedCost
- In this way we get the associated cost for the vehicle cost.
- To get the basic fee according to the rules we need to validate this:
    * if `$maxTaxedAmount * $basicFeePercent > $basicFeeMaxVal && $minTaxedAmount * $basicFeePercent > $basicFeeMaxVal`
      Then we take the max value = 50.
    * if `$maxTaxedAmount * $basicFeePercent < $basicFeeMinVal && $minTaxedAmount * $basicFeePercent < $basicFeeMinVal`
      Then we take the min value = 10.
    * else, we calculate the basic fee based on the 10% of the vehicle max amount price.
- The last step is tu calculate the max amount of the vehicle and this is get it from this operation:
    * `newMaxAmount = (maxAmount - associationFee - basicFee) / 102 * 100`
    * And to calculate the special fee `newMaxAmount * specialFeePercent`
- The values are returned to show in the app.

### Other way to solve

- The other way found is from this calculation `maxAmount = budget - storage_fee`
- After the maxAmount is calculated in a while statement or do/while statement we start to do this
  `maxAmount = maxAmount - 0.1` 0.1 means 1 cent of dollar.
- We start to calculate the basicFee, specialFee, associationCosts, storageFee and if the sum of all of them plus the
  amount is greater than the budget we continue on the bucle until is equal or less than the budget.
- Also if we don't want to use the while or do/while statement we can use recursive functions to solve the problem.

### Comments

- 2 of 7 use cases are not passing
- We can just update the fixed and variable cost but association matrix
- A couple use cases are not well formulated from the document

### Tech Stack

- Laravel 9
- PHP 8
- MySQL
- NPM
- Laravel Livewire
- Tailwind CSS

