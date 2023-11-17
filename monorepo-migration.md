Monorepo migration
===

This document explains the procedure to migrate independent packages to this monolithic repository.

**References**:
- https://gist.github.com/myusuf3/7f645819ded92bda6677
- https://tomasvotruba.com/blog/2019/10/28/all-you-always-wanted-to-know-about-monorepo-but-were-afraid-to-ask
- https://github.com/korfuri/awesome-monorepo
- https://tomasvotruba.com/blog/good-bye-monorepo/
- https://github.com/symplify/monorepo-builder
- https://amandawalkerbrubaker.medium.com/splitting-your-git-repo-while-maintaining-commit-history-35b9f4597514
- https://symfony.com/blog/symfony2-components-as-standalone-packages

Align dependencies with Monorepo Builder
---

1. Install the tool, if it isn't already present:

```
composer require symplify/monorepo-builder --dev

vendor/bin/monorepo-builder init
```

2. Run the following command, until all dependencies aren't aligned:

```vendor/bin/monorepo-builder merge```

Remove submodule if present
---

If the package to be merged has been added through a submodule, you will need to
remove the submodule configuration effectively.

1. Delete the relevant section from the `.gitmodules` file.
2. Stage the [`.gitmodules`](.gitmodules) changes with `git add .gitmodules`
3. Delete the relevant section from `.git/config`.
4. Run `git rm --cached <path_to_submodule>` (no trailing slash).
5. Run `rm -rf .git/modules/<path_to_submodule>` (no trailing slash).
6. Commit `git add <path_to_submodule>`
7. Commit `git commit -m "Migrated <package> from submodule to the monorepo"`

Add the package to automatic package split
---

In the file [`.github/workflows/package-split.yaml`](.github%2Fworkflows%2Fpackage-split.yaml) there is a
declared matrix at path `jobs.packages_split.strategy.matrix` that looks like:

```yaml
      matrix:
        # define package to repository map
        package:
          -
            local_path: 'action-contracts'
            split_repository: 'action-contracts'
```

Add your package to the list.
`local_path` represents the package's directory inside the [`packages`](packages) directory.
`split_repository` represents the git repository name inside the `github.com/php-etl` organization.
