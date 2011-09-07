# Configuration
set :application, 'EZ CMS'
set :repository,  'git@github.com:bloomtec/cake_base.git'
set :branch, 'master'
set :scm, :git

# DEPLOYMENT DIRECTORY STRUCTURE
set :deploy_to, '/home/embalao/ez.bloomweb.co'
role :app, 'ez.bloomweb.co'
role :web, 'ez.bloomweb.co'
role :db, 'mysql.bloomweb.co', :primary => true

# MISCELLANEOUS CONFIGURATION
set :user, 'bloomweb'
set :scm_username, 'rr40r900343'
set :use_sudo, false