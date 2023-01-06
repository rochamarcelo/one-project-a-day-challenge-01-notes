# One Project a Day with CakePHP - 01 Notes App

On this project is used CakePHP 5 (migrated from CakePHP 4) and bootstrap 5 

## Steps to create this project


- e0a632b `composer create-project --prefer-dist cakephp/app`
- 2280245 Bootstrap - Start up
- 3109eb2 Migrations for Notes
    ```
    bin/cake bake migration CreateNotes title note created modified
    bin/cake migrations migrate
    ```
- 612da0d Bake base components
  ```
    bin/cake bake model Notes
    bin/cake bake controller Notes
    bin/cake bake template Notes
  ```
- ac24ecd Improve index css with bootstrap
- 10a2ec3 Update paginator templates
- f64e8bb Make edit and index one page only
- 4e2e7e2 Make add part and index one page
- f26d1d9 Sort notes by modified date
- 2b3416c Update flash message styles with bootstrap
- ff729a5 Clear add form on cancel button
- fc42f09 Using svg icons using https://icons.getbootstrap.com/icons

## Upgrade to CakePHP 5

- [c7b7a49](https://github.com/rochamarcelo/one-project-a-day-challenge-01-notes/commit/c7b7a49) Upgraded to CakePHP 5.0.0-beta1 Chiffon based on a clean template (cakephp/app:5.x-dev)
- [49c4838](https://github.com/rochamarcelo/one-project-a-day-challenge-01-notes/commit/49c4838) Upgraded to CakePHP 5.0.0-beta1 Chiffon - Fixing types
