terraform {
  required_version = ">= 1.5.0"

  required_providers {
    cloudflare = {
      source  = "cloudflare/cloudflare"
      version = ">= 4.0"
    }
  }
}

variable "zone_id" {
  description = "Cloudflare Zone ID for the website."
  type        = string
}

variable "enable_cloudflare_rate_limits" {
  description = "Whether to create Cloudflare edge rate limits."
  type        = bool
  default     = true
}


locals {
  # Free plan only supports 10s period. ~17 req/10s ≈ 100 req/min.
  global_api_rate_limit_per_10s = 15
}

resource "cloudflare_ruleset" "api_rate_limits" {
  count = var.enable_cloudflare_rate_limits ? 1 : 0

  zone_id     = var.zone_id
  name        = "inkybot-api-rate-limits"
  description = "Edge rate limits mirroring Laravel endpoint throttles"
  kind        = "zone"
  phase       = "http_ratelimit"

  rules = [
    {
      description = "Global API catch-all: ~100 req/min per IP (15 per 10s)"
      enabled     = true
      action      = "block"
      expression  = "starts_with(http.request.uri.path, \"/api/\")"
      ratelimit = {
        characteristics     = ["cf.colo.id", "ip.src"]
        period              = 10
        requests_per_period = local.global_api_rate_limit_per_10s
        mitigation_timeout  = 10
      }
    }
  ]
}
