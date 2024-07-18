# Deel Test

Includes:
1. Dockerfile for nginx + php-fpm
2. PHP Class Implementation for Flipped IP
3. .github/workflows/ci-pipeline.yml

### Infra Part 1: Provision VPC+EKS using DRY: Terraform + TerraGrunt + Terraspace
https://terragrunt.gruntwork.io/docs/features/keep-your-terragrunt-architecture-dry/

    RUN terragrunt init && terragrunt apply
    infra/vpc
    infra/eks
    infra/nodeGroups/managed-node-group/internal-services
    services/ingress-nginx
    infra/metrics-server

### S3 Bucket for tfstate
    remote_state {
      backend = "s3"
      config = {
      bucket         = "my-terraform-state"
      key            = "${path_relative_to_include()}/terraform.tfstate"
      region         = "us-east-1"
      encrypt        = true
      dynamodb_table = "my-lock-table"
      }
    }


### ServiceMesh: Istio or traefik with Helm
https://doc.traefik.io/traefik/getting-started/install-traefik/

    helm repo add istio https://istio-release.storage.googleapis.com/charts
    helm repo update
    helm install istio-base istio/base -n istio-system --set defaultRevision=default

    helm repo add traefik https://traefik.github.io/charts
    helm repo update
    helm install traefik traefik/traefik
    kubectl port-forward $(kubectl get pods --selector "app.kubernetes.io/name=traefik" --output=name) 9000:9000


### GitOps Deployment with ArgoCD/App-of-Apps from Tagging to PODS
    kubectl create namespace argocd
    kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml
    kubectl port-forward svc/argocd-server -n argocd 8080:443
    kubectl apply -f application.yaml

### HelmCharts
https://helm.sh/docs/helm/helm_create/

    helm create NAME [flags]
