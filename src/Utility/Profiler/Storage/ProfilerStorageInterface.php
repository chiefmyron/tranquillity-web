<?php declare(strict_types=1);
namespace Tranquillity\Utility\Profiler\Storage;

// Application classes
use Tranquillity\Utility\Profiler\ProfileSnapshot;

interface ProfilerStorageInterface {
    /**
     * Finds profiler tokens for the given criteria.
     *
     * @param int|null $limit The maximum number of tokens to return
     * @param int|null $start The start date to search from
     * @param int|null $end   The end date to search to
     *
     * @return array An array of tokens
     */
    //public function find(?string $ip, ?string $url, ?int $limit, ?string $method, int $start = null, int $end = null): array;
    public function find(array $criteria = []);

    /**
     * Reads data associated with the given token.
     *
     * The method returns false if the token does not exist in the storage.
     *
     * @return ProfileSnapshot|null The profile associated with token
     */
    public function read(string $token): ?ProfileSnapshot;

    /**
     * Saves a ProfileSnapshot.
     *
     * @return bool Write operation successful
     */
    public function write(ProfileSnapshot $profile): bool;

    /**
     * Purges all data from the database.
     */
    public function purge();
}