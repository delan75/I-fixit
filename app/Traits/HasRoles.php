<?php

namespace App\Traits;

trait HasRoles
{
    /**
     * Check if the user has the given role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        // Superusers have access to everything
        if ($this->isSuperuser()) {
            return true;
        }

        return $this->role === $role;
    }

    /**
     * Check if the user has any of the given roles.
     *
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole(array $roles): bool
    {
        // Superusers have access to everything
        if ($this->isSuperuser()) {
            return true;
        }

        return in_array($this->role, $roles);
    }

    /**
     * Check if the user has all of the given roles.
     *
     * @param array $roles
     * @return bool
     */
    public function hasAllRoles(array $roles): bool
    {
        // Superusers have access to everything
        if ($this->isSuperuser()) {
            return true;
        }

        foreach ($roles as $role) {
            if (!$this->hasRole($role)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the user's role.
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set the user's role.
     *
     * @param string $role
     * @return $this
     */
    public function setRole(string $role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Check if the user is a superuser.
     *
     * @return bool
     */
    public function isSuperuser(): bool
    {
        return $this->is_superuser === true || $this->is_superuser === 1;
    }

    /**
     * Set the user's superuser status.
     *
     * @param bool $status
     * @return $this
     */
    public function setSuperuser(bool $status)
    {
        $this->is_superuser = $status;
        return $this;
    }
}
