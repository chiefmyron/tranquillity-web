<?php namespace Tranquillity\Enum;

use Tranquillity\Enum\AbstractEnum;

/**
 * Enumeration of HTTP status codes
 *
 * @package Tranquillity\Enum
 * @author  Andrew Patterson <patto@live.com.au>
 * @see https://httpstatuses.com/
 */

class HttpStatusCodeEnum extends AbstractEnum {
	
	// 1xx informational codes
	const Continue = 100;
	const SwitchingProtocols = 101;
	const Processing = 102;

	// 2xx success codes
	const OK = 200;
	const Created = 201;
	const Accepted = 202;
	const NonAuthoritativeInformation = 203;
	const NoContent = 204;
	const ResetContent = 205;
	const PartialContent = 206;
	const MultiStatus = 207;
	const AlreadyReported = 208;

	// 3xx redirection codes
	const MultipleChoices = 300;
	const MovedPermanently = 301;
	const Found = 302;
	const SeeOther = 303;
	const NotModified = 304;
	const UseProxy = 305;
	const TemporaryRedirect = 307;
	const PermanentRedirect = 308;

	// 4xx client error codes
	const BadRequest = 400;
	const Unauthorized = 401;
	const PaymentRequired = 402;
	const Forbidden = 403;
	const NotFound = 404;
	const MethodNotAllowed = 405;
	const NotAcceptable = 406;
	const ProxyAuthenticationRequired = 407;
	const RequestTimeout = 408;
	const Conflict = 409;
	const Gone = 410;
	const LengthRequired = 411;
	const PreconditionFailed = 412;
	const PayloadTooLarge = 413;
	const RequestUriTooLong = 414;
	const UnsupportedMediaType = 415;
	const RequestedRangeNotSatisfiable = 416;
	const ExpectationFailed = 417;
	const Teapot = 418;
	const MisdirectedRequest = 421;
	const UnprocessableEntity = 422;
	const Locked = 423;
	const FailedDependency = 424;
	const UpgradeRequired = 426;
	const PreconditionRequired = 428;
	const TooManyRequests = 429;
	const RequestHeaderFieldsTooLarge = 431;
	const ConnectionClosedWithoutResponse = 444;
	const UnavailableForLegalReasons = 451;
	const ClientClosedRequest = 499;

	// 5xx server error codes
	const InternalServerError = 500;
	const NotImplemented = 501;
	const BadGateway = 502;
	const ServiceUnavailable = 503;
	const GatewayTimeout = 504;
	const HttpVersionNotSupported = 505;
	const VariantAlsoNegotiates = 506;
	const InsufficientStorage = 507;
	const LoopDetected = 508;
	const NotExtended = 510;
	const NetworkAuthenticationRequired = 511;
	const NetworkConnectTimeoutError = 599;
}