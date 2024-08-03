##### Running Tests #####
Unit and feature tests are located in the tests directory. To run the tests, make sure your .env.testing file is configured with the correct database credentials for a test database. Then, use the following command:

php artisan test


##### TEST RESULTS ######
Below are the results from the most recent test run:

> php artisan test

   PASS  Tests\Unit\AuthTest
  ✓ a user can be authenticated                                                                                          3.08s  

   PASS  Tests\Unit\CommentTest
  ✓ a comment can be created                                                                                             0.05s  

   WARN  Tests\Unit\ExampleTest
  - that true is true → Skipping this test.                                                                              0.09s  

   PASS  Tests\Unit\PostTest
  ✓ a post can be created                                                                                                0.03s  

   PASS  Tests\Feature\AuthTest
  ✓ user can login and get token                                                                                         1.06s  

   PASS  Tests\Feature\CommentCreationTest
  ✓ authenticated user can create comment                                                                                0.09s  

   WARN  Tests\Feature\ExampleTest
  - the application returns a successful response → Skipping this test.                                                  0.01s  

   PASS  Tests\Feature\PostCreationTest
  ✓ authenticated user can create post                                                                                   0.04s  

  Tests:    2 skipped, 6 passed (10 assertions)
  Duration: 4.75s


 # Note:
Tests marked as WARN are intentionally skipped. They are example tests by Laravel.