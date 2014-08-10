require File.expand_path('../boot', __FILE__)

require 'rails'

Bundler.require(*Rails.groups)

require 'sass-rails'
require 'jquery-rails'
require 'slim-rails'
require 'bootstrap-sass'

module Dummy
  class Application < Rails::Application
    config.assets.enabled = true if config.assets.respond_to?(:enabled)
  end
end

