# Git Workflow for I-fixit Project

This document outlines the Git workflow for the I-fixit project to ensure that the production environment remains stable and that changes are properly tested before deployment.

## Branch Structure

### Main Branches

- **`main`**: The production branch that reflects the code currently deployed on the live site
- **`develop`**: The integration branch where features are combined and tested before promotion to `main`

### Supporting Branches

- **`feature/*`**: Feature branches for new development (e.g., `feature/vehicle-management`)
- **`bugfix/*`**: Branches for fixing bugs (e.g., `bugfix/login-issue`)
- **`hotfix/*`**: Emergency fixes that go directly to production (e.g., `hotfix/security-vulnerability`)
- **`release/*`**: Preparation branches for new releases (e.g., `release/v1.0.0`)

## Workflow Rules

1. **Never commit directly to `main`**
   - All changes to `main` must come through pull requests
   - The `main` branch should always be deployable

2. **Develop in feature branches**
   - Create a new branch for each feature or bugfix
   - Branch from `develop` for regular work
   - Branch from `main` only for critical hotfixes

3. **Keep branches up to date**
   - Regularly merge or rebase from the parent branch
   - Resolve conflicts locally before pushing

4. **Pull request process**
   - Create a pull request to merge your branch into `develop`
   - Ensure all tests pass
   - Get at least one code review
   - Squash commits when merging to keep history clean

5. **Deployment process**
   - Merge `develop` into `main` only when ready to deploy
   - Tag releases with version numbers (e.g., `v1.0.0`)
   - Deploy from the `main` branch only

## Git Commands Reference

### Creating Branches

```bash
# Create a feature branch
git checkout develop
git pull
git checkout -b feature/new-feature

# Create a bugfix branch
git checkout develop
git pull
git checkout -b bugfix/issue-description

# Create a hotfix branch
git checkout main
git pull
git checkout -b hotfix/critical-issue
```

### Keeping Branches Updated

```bash
# Update your branch with changes from develop
git checkout feature/your-feature
git fetch origin
git merge origin/develop

# Alternative: rebase instead of merge
git checkout feature/your-feature
git fetch origin
git rebase origin/develop
```

### Preparing for a Pull Request

```bash
# Make sure your branch is up to date
git checkout feature/your-feature
git fetch origin
git merge origin/develop

# Push your changes
git push origin feature/your-feature
```

### After Pull Request is Approved

```bash
# Merge to develop (via GitHub UI or command line)
git checkout develop
git pull
git merge --no-ff feature/your-feature
git push origin develop
```

### Deploying to Production

```bash
# Merge develop to main
git checkout main
git pull
git merge --no-ff develop
git tag -a v1.0.0 -m "Version 1.0.0"
git push origin main --tags
```

## Protecting the Production Environment

### GitHub Branch Protection

Set up branch protection rules in GitHub:

1. Go to repository Settings > Branches
2. Add rule for `main` branch:
   - Require pull request reviews before merging
   - Require status checks to pass before merging
   - Include administrators in these restrictions
   - Restrict who can push to this branch

### Pre-Deployment Checklist

Before merging to `main`:

1. All tests pass
2. Code has been reviewed
3. Changes have been tested in a staging environment
4. Database migrations are backward compatible
5. Documentation has been updated

### Post-Deployment Verification

After deploying to production:

1. Verify the site loads correctly
2. Run smoke tests on critical functionality
3. Monitor error logs for any issues
4. Be prepared to roll back if necessary

## Handling Production Hotfixes

For urgent fixes that need to bypass the normal workflow:

1. Create a `hotfix` branch from `main`
2. Make the minimal necessary changes
3. Test thoroughly
4. Create a pull request directly to `main`
5. After merging to `main` and deploying, also merge the changes back to `develop`

```bash
# Create hotfix
git checkout main
git checkout -b hotfix/critical-issue

# After hotfix is deployed to main, merge back to develop
git checkout develop
git merge --no-ff hotfix/critical-issue
git push origin develop
```

## Special Considerations for the Hostinger Setup

Given the current production setup on Hostinger:

1. **Build assets locally** before pushing to `main`
2. **Be cautious with migrations** as they can affect the production database
3. **Test environment-specific code** thoroughly
4. **Document any manual deployment steps** in the pull request description

## Automated Deployment (Future)

When setting up automated deployment:

1. Configure GitHub Actions to deploy only from the `main` branch
2. Include build and test steps in the workflow
3. Add safeguards to prevent deployment if tests fail
4. Set up notifications for successful/failed deployments
