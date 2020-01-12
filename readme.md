# Recipe Book
## WEB3 Lloen and Daniel
### Remarks
* To complete the ingredients seeding, it might take up to 20 minutes. CTRL+C anytime during the IngredientTableSeeder to stop the seed.
* The envExample.txt contains an example of the env file to use.
* To login as an adminidtrator use email: admin@admin.com password: admin. The other seeded users' password is: user.
    * Admins can: CRUD all recipes and ingredients, access list of users (/profiles), download the Excel file of users and make other users admins.
    * Logged in users can: Create recipes, Read all recipes and Update & Delete their own recipes.
    * Anoymous user can: only see the index or recipes.

### Main Points
* The PDF can be downloaded from the Read of the recipe. The excel can be downloaded from the index of users and api is placed at /api/ingredients.
* Every recipe image update has a webiste logo watermark on the bottom right corner, all user images are resized to 30x30 before storing.
* Every ingredient image is stored on the database, rest of the images is stored on the Laravel server (storage/app/public/images).


## License
The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).