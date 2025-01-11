--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.9
-- Dumped by pg_dump version 16.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: topology; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA topology;


ALTER SCHEMA topology OWNER TO postgres;

--
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry, geography, and raster spatial types and functions';


--
-- Name: postgis_topology; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS postgis_topology WITH SCHEMA topology;


--
-- Name: EXTENSION postgis_topology; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_topology IS 'PostGIS topology spatial types and functions';


--
-- Name: addbbox(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.addbbox(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_addBBOX';


ALTER FUNCTION public.addbbox(public.geometry) OWNER TO postgres;

--
-- Name: addpoint(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.addpoint(public.geometry, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_addpoint';


ALTER FUNCTION public.addpoint(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: addpoint(public.geometry, public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.addpoint(public.geometry, public.geometry, integer) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_addpoint';


ALTER FUNCTION public.addpoint(public.geometry, public.geometry, integer) OWNER TO postgres;

--
-- Name: affine(public.geometry, double precision, double precision, double precision, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.affine(public.geometry, double precision, double precision, double precision, double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_affine($1,  $2, $3, 0,  $4, $5, 0,  0, 0, 1,  $6, $7, 0)$_$;


ALTER FUNCTION public.affine(public.geometry, double precision, double precision, double precision, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: affine(public.geometry, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.affine(public.geometry, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_affine';


ALTER FUNCTION public.affine(public.geometry, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: area(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.area(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_area_polygon';


ALTER FUNCTION public.area(public.geometry) OWNER TO postgres;

--
-- Name: area2d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.area2d(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_area_polygon';


ALTER FUNCTION public.area2d(public.geometry) OWNER TO postgres;

--
-- Name: asbinary(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.asbinary(public.geometry) RETURNS bytea
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asBinary';


ALTER FUNCTION public.asbinary(public.geometry) OWNER TO postgres;

--
-- Name: asbinary(public.geometry, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.asbinary(public.geometry, text) RETURNS bytea
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asBinary';


ALTER FUNCTION public.asbinary(public.geometry, text) OWNER TO postgres;

--
-- Name: asewkb(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.asewkb(public.geometry) RETURNS bytea
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'WKBFromLWGEOM';


ALTER FUNCTION public.asewkb(public.geometry) OWNER TO postgres;

--
-- Name: asewkb(public.geometry, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.asewkb(public.geometry, text) RETURNS bytea
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'WKBFromLWGEOM';


ALTER FUNCTION public.asewkb(public.geometry, text) OWNER TO postgres;

--
-- Name: asewkt(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.asewkt(public.geometry) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asEWKT';


ALTER FUNCTION public.asewkt(public.geometry) OWNER TO postgres;

--
-- Name: asgml(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.asgml(public.geometry) RETURNS text
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT _ST_AsGML(2, $1, 15, 0, null)$_$;


ALTER FUNCTION public.asgml(public.geometry) OWNER TO postgres;

--
-- Name: asgml(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.asgml(public.geometry, integer) RETURNS text
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT _ST_AsGML(2, $1, $2, 0, null)$_$;


ALTER FUNCTION public.asgml(public.geometry, integer) OWNER TO postgres;

--
-- Name: ashexewkb(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ashexewkb(public.geometry) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asHEXEWKB';


ALTER FUNCTION public.ashexewkb(public.geometry) OWNER TO postgres;

--
-- Name: ashexewkb(public.geometry, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ashexewkb(public.geometry, text) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asHEXEWKB';


ALTER FUNCTION public.ashexewkb(public.geometry, text) OWNER TO postgres;

--
-- Name: askml(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.askml(public.geometry) RETURNS text
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT _ST_AsKML(2, ST_Transform($1,4326), 15, null)$_$;


ALTER FUNCTION public.askml(public.geometry) OWNER TO postgres;

--
-- Name: askml(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.askml(public.geometry, integer) RETURNS text
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT _ST_AsKML(2, ST_transform($1,4326), $2, null)$_$;


ALTER FUNCTION public.askml(public.geometry, integer) OWNER TO postgres;

--
-- Name: askml(integer, public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.askml(integer, public.geometry, integer) RETURNS text
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT _ST_AsKML($1, ST_Transform($2,4326), $3, null)$_$;


ALTER FUNCTION public.askml(integer, public.geometry, integer) OWNER TO postgres;

--
-- Name: assvg(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.assvg(public.geometry) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asSVG';


ALTER FUNCTION public.assvg(public.geometry) OWNER TO postgres;

--
-- Name: assvg(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.assvg(public.geometry, integer) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asSVG';


ALTER FUNCTION public.assvg(public.geometry, integer) OWNER TO postgres;

--
-- Name: assvg(public.geometry, integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.assvg(public.geometry, integer, integer) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asSVG';


ALTER FUNCTION public.assvg(public.geometry, integer, integer) OWNER TO postgres;

--
-- Name: astext(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.astext(public.geometry) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_asText';


ALTER FUNCTION public.astext(public.geometry) OWNER TO postgres;

--
-- Name: azimuth(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.azimuth(public.geometry, public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_azimuth';


ALTER FUNCTION public.azimuth(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: bdmpolyfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.bdmpolyfromtext(text, integer) RETURNS public.geometry
    LANGUAGE plpgsql IMMUTABLE STRICT
    AS $_$
DECLARE
	geomtext alias for $1;
	srid alias for $2;
	mline geometry;
	geom geometry;
BEGIN
	mline := ST_MultiLineStringFromText(geomtext, srid);

	IF mline IS NULL
	THEN
		RAISE EXCEPTION 'Input is not a MultiLinestring';
	END IF;

	geom := ST_Multi(ST_BuildArea(mline));

	RETURN geom;
END;
$_$;


ALTER FUNCTION public.bdmpolyfromtext(text, integer) OWNER TO postgres;

--
-- Name: bdpolyfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.bdpolyfromtext(text, integer) RETURNS public.geometry
    LANGUAGE plpgsql IMMUTABLE STRICT
    AS $_$
DECLARE
	geomtext alias for $1;
	srid alias for $2;
	mline geometry;
	geom geometry;
BEGIN
	mline := ST_MultiLineStringFromText(geomtext, srid);

	IF mline IS NULL
	THEN
		RAISE EXCEPTION 'Input is not a MultiLinestring';
	END IF;

	geom := ST_BuildArea(mline);

	IF GeometryType(geom) != 'POLYGON'
	THEN
		RAISE EXCEPTION 'Input returns more then a single polygon, try using BdMPolyFromText instead';
	END IF;

	RETURN geom;
END;
$_$;


ALTER FUNCTION public.bdpolyfromtext(text, integer) OWNER TO postgres;

--
-- Name: boundary(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.boundary(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'boundary';


ALTER FUNCTION public.boundary(public.geometry) OWNER TO postgres;

--
-- Name: buffer(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.buffer(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'buffer';


ALTER FUNCTION public.buffer(public.geometry, double precision) OWNER TO postgres;

--
-- Name: buffer(public.geometry, double precision, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.buffer(public.geometry, double precision, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT ST_Buffer($1, $2, $3)$_$;


ALTER FUNCTION public.buffer(public.geometry, double precision, integer) OWNER TO postgres;

--
-- Name: buildarea(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.buildarea(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'ST_BuildArea';


ALTER FUNCTION public.buildarea(public.geometry) OWNER TO postgres;

--
-- Name: centroid(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.centroid(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'centroid';


ALTER FUNCTION public.centroid(public.geometry) OWNER TO postgres;

--
-- Name: collect(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.collect(public.geometry, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE
    AS '$libdir/postgis-2.0', 'LWGEOM_collect';


ALTER FUNCTION public.collect(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: combine_bbox(public.box2d, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.combine_bbox(public.box2d, public.geometry) RETURNS public.box2d
    LANGUAGE c IMMUTABLE
    AS '$libdir/postgis-2.0', 'BOX2D_combine';


ALTER FUNCTION public.combine_bbox(public.box2d, public.geometry) OWNER TO postgres;

--
-- Name: combine_bbox(public.box3d, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.combine_bbox(public.box3d, public.geometry) RETURNS public.box3d
    LANGUAGE c IMMUTABLE
    AS '$libdir/postgis-2.0', 'BOX3D_combine';


ALTER FUNCTION public.combine_bbox(public.box3d, public.geometry) OWNER TO postgres;

--
-- Name: contains(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.contains(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'contains';


ALTER FUNCTION public.contains(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: contar_usuarios(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.contar_usuarios(OUT total integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
BEGIN
    SELECT COUNT(*) INTO total FROM usuarios;
END;
$$;


ALTER FUNCTION public.contar_usuarios(OUT total integer) OWNER TO postgres;

--
-- Name: convexhull(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.convexhull(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'convexhull';


ALTER FUNCTION public.convexhull(public.geometry) OWNER TO postgres;

--
-- Name: crosses(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.crosses(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'crosses';


ALTER FUNCTION public.crosses(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: difference(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.difference(public.geometry, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'difference';


ALTER FUNCTION public.difference(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: dimension(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.dimension(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_dimension';


ALTER FUNCTION public.dimension(public.geometry) OWNER TO postgres;

--
-- Name: disjoint(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.disjoint(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'disjoint';


ALTER FUNCTION public.disjoint(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: distance(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.distance(public.geometry, public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'LWGEOM_mindistance2d';


ALTER FUNCTION public.distance(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: distance_sphere(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.distance_sphere(public.geometry, public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'LWGEOM_distance_sphere';


ALTER FUNCTION public.distance_sphere(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: distance_spheroid(public.geometry, public.geometry, public.spheroid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.distance_spheroid(public.geometry, public.geometry, public.spheroid) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'LWGEOM_distance_ellipsoid';


ALTER FUNCTION public.distance_spheroid(public.geometry, public.geometry, public.spheroid) OWNER TO postgres;

--
-- Name: dropbbox(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.dropbbox(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_dropBBOX';


ALTER FUNCTION public.dropbbox(public.geometry) OWNER TO postgres;

--
-- Name: dump(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.dump(public.geometry) RETURNS SETOF public.geometry_dump
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_dump';


ALTER FUNCTION public.dump(public.geometry) OWNER TO postgres;

--
-- Name: dumprings(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.dumprings(public.geometry) RETURNS SETOF public.geometry_dump
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_dump_rings';


ALTER FUNCTION public.dumprings(public.geometry) OWNER TO postgres;

--
-- Name: endpoint(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.endpoint(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_endpoint_linestring';


ALTER FUNCTION public.endpoint(public.geometry) OWNER TO postgres;

--
-- Name: envelope(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.envelope(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_envelope';


ALTER FUNCTION public.envelope(public.geometry) OWNER TO postgres;

--
-- Name: estimated_extent(text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.estimated_extent(text, text) RETURNS public.box2d
    LANGUAGE c IMMUTABLE STRICT SECURITY DEFINER
    AS '$libdir/postgis-2.0', 'geometry_estimated_extent';


ALTER FUNCTION public.estimated_extent(text, text) OWNER TO postgres;

--
-- Name: estimated_extent(text, text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.estimated_extent(text, text, text) RETURNS public.box2d
    LANGUAGE c IMMUTABLE STRICT SECURITY DEFINER
    AS '$libdir/postgis-2.0', 'geometry_estimated_extent';


ALTER FUNCTION public.estimated_extent(text, text, text) OWNER TO postgres;

--
-- Name: expand(public.box2d, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.expand(public.box2d, double precision) RETURNS public.box2d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX2D_expand';


ALTER FUNCTION public.expand(public.box2d, double precision) OWNER TO postgres;

--
-- Name: expand(public.box3d, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.expand(public.box3d, double precision) RETURNS public.box3d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_expand';


ALTER FUNCTION public.expand(public.box3d, double precision) OWNER TO postgres;

--
-- Name: expand(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.expand(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_expand';


ALTER FUNCTION public.expand(public.geometry, double precision) OWNER TO postgres;

--
-- Name: exteriorring(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.exteriorring(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_exteriorring_polygon';


ALTER FUNCTION public.exteriorring(public.geometry) OWNER TO postgres;

--
-- Name: find_extent(text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.find_extent(text, text) RETURNS public.box2d
    LANGUAGE plpgsql IMMUTABLE STRICT
    AS $_$
DECLARE
	tablename alias for $1;
	columnname alias for $2;
	myrec RECORD;

BEGIN
	FOR myrec IN EXECUTE 'SELECT ST_Extent("' || columnname || '") As extent FROM "' || tablename || '"' LOOP
		return myrec.extent;
	END LOOP;
END;
$_$;


ALTER FUNCTION public.find_extent(text, text) OWNER TO postgres;

--
-- Name: find_extent(text, text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.find_extent(text, text, text) RETURNS public.box2d
    LANGUAGE plpgsql IMMUTABLE STRICT
    AS $_$
DECLARE
	schemaname alias for $1;
	tablename alias for $2;
	columnname alias for $3;
	myrec RECORD;

BEGIN
	FOR myrec IN EXECUTE 'SELECT ST_Extent("' || columnname || '") FROM "' || schemaname || '"."' || tablename || '" As extent ' LOOP
		return myrec.extent;
	END LOOP;
END;
$_$;


ALTER FUNCTION public.find_extent(text, text, text) OWNER TO postgres;

--
-- Name: fix_geometry_columns(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.fix_geometry_columns() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	mislinked record;
	result text;
	linked integer;
	deleted integer;
	foundschema integer;
BEGIN

	-- Since 7.3 schema support has been added.
	-- Previous postgis versions used to put the database name in
	-- the schema column. This needs to be fixed, so we try to
	-- set the correct schema for each geometry_colums record
	-- looking at table, column, type and srid.
	
	return 'This function is obsolete now that geometry_columns is a view';

END;
$$;


ALTER FUNCTION public.fix_geometry_columns() OWNER TO postgres;

--
-- Name: force_2d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.force_2d(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_force_2d';


ALTER FUNCTION public.force_2d(public.geometry) OWNER TO postgres;

--
-- Name: force_3d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.force_3d(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_force_3dz';


ALTER FUNCTION public.force_3d(public.geometry) OWNER TO postgres;

--
-- Name: force_3dm(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.force_3dm(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_force_3dm';


ALTER FUNCTION public.force_3dm(public.geometry) OWNER TO postgres;

--
-- Name: force_3dz(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.force_3dz(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_force_3dz';


ALTER FUNCTION public.force_3dz(public.geometry) OWNER TO postgres;

--
-- Name: force_4d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.force_4d(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_force_4d';


ALTER FUNCTION public.force_4d(public.geometry) OWNER TO postgres;

--
-- Name: force_collection(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.force_collection(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_force_collection';


ALTER FUNCTION public.force_collection(public.geometry) OWNER TO postgres;

--
-- Name: forcerhr(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.forcerhr(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_force_clockwise_poly';


ALTER FUNCTION public.forcerhr(public.geometry) OWNER TO postgres;

--
-- Name: geomcollfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomcollfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE
	WHEN geometrytype(GeomFromText($1)) = 'GEOMETRYCOLLECTION'
	THEN GeomFromText($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.geomcollfromtext(text) OWNER TO postgres;

--
-- Name: geomcollfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomcollfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE
	WHEN geometrytype(GeomFromText($1, $2)) = 'GEOMETRYCOLLECTION'
	THEN GeomFromText($1,$2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.geomcollfromtext(text, integer) OWNER TO postgres;

--
-- Name: geomcollfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomcollfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE
	WHEN geometrytype(GeomFromWKB($1)) = 'GEOMETRYCOLLECTION'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.geomcollfromwkb(bytea) OWNER TO postgres;

--
-- Name: geomcollfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomcollfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE
	WHEN geometrytype(GeomFromWKB($1, $2)) = 'GEOMETRYCOLLECTION'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.geomcollfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: geometryfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geometryfromtext(text) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_from_text';


ALTER FUNCTION public.geometryfromtext(text) OWNER TO postgres;

--
-- Name: geometryfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geometryfromtext(text, integer) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_from_text';


ALTER FUNCTION public.geometryfromtext(text, integer) OWNER TO postgres;

--
-- Name: geometryn(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geometryn(public.geometry, integer) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_geometryn_collection';


ALTER FUNCTION public.geometryn(public.geometry, integer) OWNER TO postgres;

--
-- Name: geomfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT ST_GeomFromText($1)$_$;


ALTER FUNCTION public.geomfromtext(text) OWNER TO postgres;

--
-- Name: geomfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT ST_GeomFromText($1, $2)$_$;


ALTER FUNCTION public.geomfromtext(text, integer) OWNER TO postgres;

--
-- Name: geomfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomfromwkb(bytea) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_from_WKB';


ALTER FUNCTION public.geomfromwkb(bytea) OWNER TO postgres;

--
-- Name: geomfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT ST_SetSRID(ST_GeomFromWKB($1), $2)$_$;


ALTER FUNCTION public.geomfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: geomunion(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.geomunion(public.geometry, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'geomunion';


ALTER FUNCTION public.geomunion(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: getbbox(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.getbbox(public.geometry) RETURNS public.box2d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_to_BOX2D';


ALTER FUNCTION public.getbbox(public.geometry) OWNER TO postgres;

--
-- Name: getsrid(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.getsrid(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_get_srid';


ALTER FUNCTION public.getsrid(public.geometry) OWNER TO postgres;

--
-- Name: hasbbox(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.hasbbox(public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_hasBBOX';


ALTER FUNCTION public.hasbbox(public.geometry) OWNER TO postgres;

--
-- Name: interiorringn(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.interiorringn(public.geometry, integer) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_interiorringn_polygon';


ALTER FUNCTION public.interiorringn(public.geometry, integer) OWNER TO postgres;

--
-- Name: intersection(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.intersection(public.geometry, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'intersection';


ALTER FUNCTION public.intersection(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: intersects(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.intersects(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'intersects';


ALTER FUNCTION public.intersects(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: isclosed(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.isclosed(public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_isclosed';


ALTER FUNCTION public.isclosed(public.geometry) OWNER TO postgres;

--
-- Name: isempty(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.isempty(public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_isempty';


ALTER FUNCTION public.isempty(public.geometry) OWNER TO postgres;

--
-- Name: isring(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.isring(public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'isring';


ALTER FUNCTION public.isring(public.geometry) OWNER TO postgres;

--
-- Name: issimple(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.issimple(public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'issimple';


ALTER FUNCTION public.issimple(public.geometry) OWNER TO postgres;

--
-- Name: isvalid(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.isvalid(public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'isvalid';


ALTER FUNCTION public.isvalid(public.geometry) OWNER TO postgres;

--
-- Name: length(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.length(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_length_linestring';


ALTER FUNCTION public.length(public.geometry) OWNER TO postgres;

--
-- Name: length2d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.length2d(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_length2d_linestring';


ALTER FUNCTION public.length2d(public.geometry) OWNER TO postgres;

--
-- Name: length2d_spheroid(public.geometry, public.spheroid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.length2d_spheroid(public.geometry, public.spheroid) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'LWGEOM_length2d_ellipsoid';


ALTER FUNCTION public.length2d_spheroid(public.geometry, public.spheroid) OWNER TO postgres;

--
-- Name: length3d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.length3d(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_length_linestring';


ALTER FUNCTION public.length3d(public.geometry) OWNER TO postgres;

--
-- Name: length3d_spheroid(public.geometry, public.spheroid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.length3d_spheroid(public.geometry, public.spheroid) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_length_ellipsoid_linestring';


ALTER FUNCTION public.length3d_spheroid(public.geometry, public.spheroid) OWNER TO postgres;

--
-- Name: length_spheroid(public.geometry, public.spheroid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.length_spheroid(public.geometry, public.spheroid) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'LWGEOM_length_ellipsoid_linestring';


ALTER FUNCTION public.length_spheroid(public.geometry, public.spheroid) OWNER TO postgres;

--
-- Name: line_interpolate_point(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.line_interpolate_point(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_line_interpolate_point';


ALTER FUNCTION public.line_interpolate_point(public.geometry, double precision) OWNER TO postgres;

--
-- Name: line_locate_point(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.line_locate_point(public.geometry, public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_line_locate_point';


ALTER FUNCTION public.line_locate_point(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: line_substring(public.geometry, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.line_substring(public.geometry, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_line_substring';


ALTER FUNCTION public.line_substring(public.geometry, double precision, double precision) OWNER TO postgres;

--
-- Name: linefrommultipoint(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linefrommultipoint(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_line_from_mpoint';


ALTER FUNCTION public.linefrommultipoint(public.geometry) OWNER TO postgres;

--
-- Name: linefromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linefromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1)) = 'LINESTRING'
	THEN GeomFromText($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.linefromtext(text) OWNER TO postgres;

--
-- Name: linefromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linefromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1, $2)) = 'LINESTRING'
	THEN GeomFromText($1,$2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.linefromtext(text, integer) OWNER TO postgres;

--
-- Name: linefromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linefromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'LINESTRING'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.linefromwkb(bytea) OWNER TO postgres;

--
-- Name: linefromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linefromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1, $2)) = 'LINESTRING'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.linefromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: linemerge(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linemerge(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'linemerge';


ALTER FUNCTION public.linemerge(public.geometry) OWNER TO postgres;

--
-- Name: linestringfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linestringfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT LineFromText($1)$_$;


ALTER FUNCTION public.linestringfromtext(text) OWNER TO postgres;

--
-- Name: linestringfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linestringfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT LineFromText($1, $2)$_$;


ALTER FUNCTION public.linestringfromtext(text, integer) OWNER TO postgres;

--
-- Name: linestringfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linestringfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'LINESTRING'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.linestringfromwkb(bytea) OWNER TO postgres;

--
-- Name: linestringfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.linestringfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1, $2)) = 'LINESTRING'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.linestringfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: locate_along_measure(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.locate_along_measure(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$ SELECT ST_locate_between_measures($1, $2, $2) $_$;


ALTER FUNCTION public.locate_along_measure(public.geometry, double precision) OWNER TO postgres;

--
-- Name: locate_between_measures(public.geometry, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.locate_between_measures(public.geometry, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_locate_between_m';


ALTER FUNCTION public.locate_between_measures(public.geometry, double precision, double precision) OWNER TO postgres;

--
-- Name: m(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.m(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_m_point';


ALTER FUNCTION public.m(public.geometry) OWNER TO postgres;

--
-- Name: makebox2d(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makebox2d(public.geometry, public.geometry) RETURNS public.box2d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX2D_construct';


ALTER FUNCTION public.makebox2d(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: makebox3d(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makebox3d(public.geometry, public.geometry) RETURNS public.box3d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_construct';


ALTER FUNCTION public.makebox3d(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: makeline(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makeline(public.geometry, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makeline';


ALTER FUNCTION public.makeline(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: makeline_garray(public.geometry[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makeline_garray(public.geometry[]) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makeline_garray';


ALTER FUNCTION public.makeline_garray(public.geometry[]) OWNER TO postgres;

--
-- Name: makepoint(double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makepoint(double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makepoint';


ALTER FUNCTION public.makepoint(double precision, double precision) OWNER TO postgres;

--
-- Name: makepoint(double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makepoint(double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makepoint';


ALTER FUNCTION public.makepoint(double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: makepoint(double precision, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makepoint(double precision, double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makepoint';


ALTER FUNCTION public.makepoint(double precision, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: makepointm(double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makepointm(double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makepoint3dm';


ALTER FUNCTION public.makepointm(double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: makepolygon(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makepolygon(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makepoly';


ALTER FUNCTION public.makepolygon(public.geometry) OWNER TO postgres;

--
-- Name: makepolygon(public.geometry, public.geometry[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.makepolygon(public.geometry, public.geometry[]) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makepoly';


ALTER FUNCTION public.makepolygon(public.geometry, public.geometry[]) OWNER TO postgres;

--
-- Name: max_distance(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.max_distance(public.geometry, public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_maxdistance2d_linestring';


ALTER FUNCTION public.max_distance(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: mem_size(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mem_size(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_mem_size';


ALTER FUNCTION public.mem_size(public.geometry) OWNER TO postgres;

--
-- Name: mlinefromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mlinefromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1)) = 'MULTILINESTRING'
	THEN GeomFromText($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mlinefromtext(text) OWNER TO postgres;

--
-- Name: mlinefromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mlinefromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE
	WHEN geometrytype(GeomFromText($1, $2)) = 'MULTILINESTRING'
	THEN GeomFromText($1,$2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mlinefromtext(text, integer) OWNER TO postgres;

--
-- Name: mlinefromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mlinefromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'MULTILINESTRING'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mlinefromwkb(bytea) OWNER TO postgres;

--
-- Name: mlinefromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mlinefromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1, $2)) = 'MULTILINESTRING'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mlinefromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: mpointfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mpointfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1)) = 'MULTIPOINT'
	THEN GeomFromText($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mpointfromtext(text) OWNER TO postgres;

--
-- Name: mpointfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mpointfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1,$2)) = 'MULTIPOINT'
	THEN GeomFromText($1,$2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mpointfromtext(text, integer) OWNER TO postgres;

--
-- Name: mpointfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mpointfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'MULTIPOINT'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mpointfromwkb(bytea) OWNER TO postgres;

--
-- Name: mpointfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mpointfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1,$2)) = 'MULTIPOINT'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mpointfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: mpolyfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mpolyfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1)) = 'MULTIPOLYGON'
	THEN GeomFromText($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mpolyfromtext(text) OWNER TO postgres;

--
-- Name: mpolyfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mpolyfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1, $2)) = 'MULTIPOLYGON'
	THEN GeomFromText($1,$2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mpolyfromtext(text, integer) OWNER TO postgres;

--
-- Name: mpolyfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mpolyfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'MULTIPOLYGON'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mpolyfromwkb(bytea) OWNER TO postgres;

--
-- Name: mpolyfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.mpolyfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1, $2)) = 'MULTIPOLYGON'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.mpolyfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: multi(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multi(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_force_multi';


ALTER FUNCTION public.multi(public.geometry) OWNER TO postgres;

--
-- Name: multilinefromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multilinefromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'MULTILINESTRING'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.multilinefromwkb(bytea) OWNER TO postgres;

--
-- Name: multilinefromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multilinefromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1, $2)) = 'MULTILINESTRING'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.multilinefromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: multilinestringfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multilinestringfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT ST_MLineFromText($1)$_$;


ALTER FUNCTION public.multilinestringfromtext(text) OWNER TO postgres;

--
-- Name: multilinestringfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multilinestringfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT MLineFromText($1, $2)$_$;


ALTER FUNCTION public.multilinestringfromtext(text, integer) OWNER TO postgres;

--
-- Name: multipointfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multipointfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT MPointFromText($1)$_$;


ALTER FUNCTION public.multipointfromtext(text) OWNER TO postgres;

--
-- Name: multipointfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multipointfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT MPointFromText($1, $2)$_$;


ALTER FUNCTION public.multipointfromtext(text, integer) OWNER TO postgres;

--
-- Name: multipointfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multipointfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'MULTIPOINT'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.multipointfromwkb(bytea) OWNER TO postgres;

--
-- Name: multipointfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multipointfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1,$2)) = 'MULTIPOINT'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.multipointfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: multipolyfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multipolyfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'MULTIPOLYGON'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.multipolyfromwkb(bytea) OWNER TO postgres;

--
-- Name: multipolyfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multipolyfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1, $2)) = 'MULTIPOLYGON'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.multipolyfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: multipolygonfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multipolygonfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT MPolyFromText($1)$_$;


ALTER FUNCTION public.multipolygonfromtext(text) OWNER TO postgres;

--
-- Name: multipolygonfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.multipolygonfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT MPolyFromText($1, $2)$_$;


ALTER FUNCTION public.multipolygonfromtext(text, integer) OWNER TO postgres;

--
-- Name: ndims(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ndims(public.geometry) RETURNS smallint
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_ndims';


ALTER FUNCTION public.ndims(public.geometry) OWNER TO postgres;

--
-- Name: noop(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.noop(public.geometry) RETURNS public.geometry
    LANGUAGE c STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_noop';


ALTER FUNCTION public.noop(public.geometry) OWNER TO postgres;

--
-- Name: npoints(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.npoints(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_npoints';


ALTER FUNCTION public.npoints(public.geometry) OWNER TO postgres;

--
-- Name: nrings(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.nrings(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_nrings';


ALTER FUNCTION public.nrings(public.geometry) OWNER TO postgres;

--
-- Name: numgeometries(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.numgeometries(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_numgeometries_collection';


ALTER FUNCTION public.numgeometries(public.geometry) OWNER TO postgres;

--
-- Name: numinteriorring(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.numinteriorring(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_numinteriorrings_polygon';


ALTER FUNCTION public.numinteriorring(public.geometry) OWNER TO postgres;

--
-- Name: numinteriorrings(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.numinteriorrings(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_numinteriorrings_polygon';


ALTER FUNCTION public.numinteriorrings(public.geometry) OWNER TO postgres;

--
-- Name: numpoints(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.numpoints(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_numpoints_linestring';


ALTER FUNCTION public.numpoints(public.geometry) OWNER TO postgres;

--
-- Name: overlaps(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public."overlaps"(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'overlaps';


ALTER FUNCTION public."overlaps"(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: perimeter2d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.perimeter2d(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_perimeter2d_poly';


ALTER FUNCTION public.perimeter2d(public.geometry) OWNER TO postgres;

--
-- Name: perimeter3d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.perimeter3d(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_perimeter_poly';


ALTER FUNCTION public.perimeter3d(public.geometry) OWNER TO postgres;

--
-- Name: point_inside_circle(public.geometry, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.point_inside_circle(public.geometry, double precision, double precision, double precision) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_inside_circle_point';


ALTER FUNCTION public.point_inside_circle(public.geometry, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: pointfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pointfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1)) = 'POINT'
	THEN GeomFromText($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.pointfromtext(text) OWNER TO postgres;

--
-- Name: pointfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pointfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1, $2)) = 'POINT'
	THEN GeomFromText($1,$2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.pointfromtext(text, integer) OWNER TO postgres;

--
-- Name: pointfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pointfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'POINT'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.pointfromwkb(bytea) OWNER TO postgres;

--
-- Name: pointfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pointfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(ST_GeomFromWKB($1, $2)) = 'POINT'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.pointfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: pointn(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pointn(public.geometry, integer) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_pointn_linestring';


ALTER FUNCTION public.pointn(public.geometry, integer) OWNER TO postgres;

--
-- Name: pointonsurface(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.pointonsurface(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'pointonsurface';


ALTER FUNCTION public.pointonsurface(public.geometry) OWNER TO postgres;

--
-- Name: polyfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polyfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1)) = 'POLYGON'
	THEN GeomFromText($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.polyfromtext(text) OWNER TO postgres;

--
-- Name: polyfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polyfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromText($1, $2)) = 'POLYGON'
	THEN GeomFromText($1,$2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.polyfromtext(text, integer) OWNER TO postgres;

--
-- Name: polyfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polyfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'POLYGON'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.polyfromwkb(bytea) OWNER TO postgres;

--
-- Name: polyfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polyfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1, $2)) = 'POLYGON'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.polyfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: polygonfromtext(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polygonfromtext(text) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT PolyFromText($1)$_$;


ALTER FUNCTION public.polygonfromtext(text) OWNER TO postgres;

--
-- Name: polygonfromtext(text, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polygonfromtext(text, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT PolyFromText($1, $2)$_$;


ALTER FUNCTION public.polygonfromtext(text, integer) OWNER TO postgres;

--
-- Name: polygonfromwkb(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polygonfromwkb(bytea) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1)) = 'POLYGON'
	THEN GeomFromWKB($1)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.polygonfromwkb(bytea) OWNER TO postgres;

--
-- Name: polygonfromwkb(bytea, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polygonfromwkb(bytea, integer) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$
	SELECT CASE WHEN geometrytype(GeomFromWKB($1,$2)) = 'POLYGON'
	THEN GeomFromWKB($1, $2)
	ELSE NULL END
	$_$;


ALTER FUNCTION public.polygonfromwkb(bytea, integer) OWNER TO postgres;

--
-- Name: polygonize_garray(public.geometry[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.polygonize_garray(public.geometry[]) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'polygonize_garray';


ALTER FUNCTION public.polygonize_garray(public.geometry[]) OWNER TO postgres;

--
-- Name: probe_geometry_columns(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.probe_geometry_columns() RETURNS text
    LANGUAGE plpgsql
    AS $$
DECLARE
	inserted integer;
	oldcount integer;
	probed integer;
	stale integer;
BEGIN





	RETURN 'This function is obsolete now that geometry_columns is a view';
END

$$;


ALTER FUNCTION public.probe_geometry_columns() OWNER TO postgres;

--
-- Name: registrar_usuario(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.registrar_usuario() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO auditoria_usuarios(usuario_id, fecha)
    VALUES (NEW.usu_id, NOW()); 
    RETURN NEW;
END;
$$;


ALTER FUNCTION public.registrar_usuario() OWNER TO postgres;

--
-- Name: relate(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.relate(public.geometry, public.geometry) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'relate_full';


ALTER FUNCTION public.relate(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: relate(public.geometry, public.geometry, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.relate(public.geometry, public.geometry, text) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'relate_pattern';


ALTER FUNCTION public.relate(public.geometry, public.geometry, text) OWNER TO postgres;

--
-- Name: removepoint(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.removepoint(public.geometry, integer) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_removepoint';


ALTER FUNCTION public.removepoint(public.geometry, integer) OWNER TO postgres;

--
-- Name: rename_geometry_table_constraints(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.rename_geometry_table_constraints() RETURNS text
    LANGUAGE sql IMMUTABLE
    AS $$
SELECT 'rename_geometry_table_constraint() is obsoleted'::text
$$;


ALTER FUNCTION public.rename_geometry_table_constraints() OWNER TO postgres;

--
-- Name: reverse(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.reverse(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_reverse';


ALTER FUNCTION public.reverse(public.geometry) OWNER TO postgres;

--
-- Name: rotate(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.rotate(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_rotateZ($1, $2)$_$;


ALTER FUNCTION public.rotate(public.geometry, double precision) OWNER TO postgres;

--
-- Name: rotatex(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.rotatex(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_affine($1, 1, 0, 0, 0, cos($2), -sin($2), 0, sin($2), cos($2), 0, 0, 0)$_$;


ALTER FUNCTION public.rotatex(public.geometry, double precision) OWNER TO postgres;

--
-- Name: rotatey(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.rotatey(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_affine($1,  cos($2), 0, sin($2),  0, 1, 0,  -sin($2), 0, cos($2), 0,  0, 0)$_$;


ALTER FUNCTION public.rotatey(public.geometry, double precision) OWNER TO postgres;

--
-- Name: rotatez(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.rotatez(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_affine($1,  cos($2), -sin($2), 0,  sin($2), cos($2), 0,  0, 0, 1,  0, 0, 0)$_$;


ALTER FUNCTION public.rotatez(public.geometry, double precision) OWNER TO postgres;

--
-- Name: scale(public.geometry, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.scale(public.geometry, double precision, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_scale($1, $2, $3, 1)$_$;


ALTER FUNCTION public.scale(public.geometry, double precision, double precision) OWNER TO postgres;

--
-- Name: scale(public.geometry, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.scale(public.geometry, double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_affine($1,  $2, 0, 0,  0, $3, 0,  0, 0, $4,  0, 0, 0)$_$;


ALTER FUNCTION public.scale(public.geometry, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: se_envelopesintersect(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.se_envelopesintersect(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$ 
	SELECT $1 && $2
	$_$;


ALTER FUNCTION public.se_envelopesintersect(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: se_is3d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.se_is3d(public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_hasz';


ALTER FUNCTION public.se_is3d(public.geometry) OWNER TO postgres;

--
-- Name: se_ismeasured(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.se_ismeasured(public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_hasm';


ALTER FUNCTION public.se_ismeasured(public.geometry) OWNER TO postgres;

--
-- Name: se_locatealong(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.se_locatealong(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$ SELECT SE_LocateBetween($1, $2, $2) $_$;


ALTER FUNCTION public.se_locatealong(public.geometry, double precision) OWNER TO postgres;

--
-- Name: se_locatebetween(public.geometry, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.se_locatebetween(public.geometry, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_locate_between_m';


ALTER FUNCTION public.se_locatebetween(public.geometry, double precision, double precision) OWNER TO postgres;

--
-- Name: se_m(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.se_m(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_m_point';


ALTER FUNCTION public.se_m(public.geometry) OWNER TO postgres;

--
-- Name: se_z(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.se_z(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_z_point';


ALTER FUNCTION public.se_z(public.geometry) OWNER TO postgres;

--
-- Name: segmentize(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.segmentize(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_segmentize2d';


ALTER FUNCTION public.segmentize(public.geometry, double precision) OWNER TO postgres;

--
-- Name: setpoint(public.geometry, integer, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.setpoint(public.geometry, integer, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_setpoint_linestring';


ALTER FUNCTION public.setpoint(public.geometry, integer, public.geometry) OWNER TO postgres;

--
-- Name: setsrid(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.setsrid(public.geometry, integer) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_set_srid';


ALTER FUNCTION public.setsrid(public.geometry, integer) OWNER TO postgres;

--
-- Name: shift_longitude(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.shift_longitude(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_longitude_shift';


ALTER FUNCTION public.shift_longitude(public.geometry) OWNER TO postgres;

--
-- Name: simplify(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.simplify(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_simplify2d';


ALTER FUNCTION public.simplify(public.geometry, double precision) OWNER TO postgres;

--
-- Name: snaptogrid(public.geometry, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.snaptogrid(public.geometry, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT ST_SnapToGrid($1, 0, 0, $2, $2)$_$;


ALTER FUNCTION public.snaptogrid(public.geometry, double precision) OWNER TO postgres;

--
-- Name: snaptogrid(public.geometry, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.snaptogrid(public.geometry, double precision, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT ST_SnapToGrid($1, 0, 0, $2, $3)$_$;


ALTER FUNCTION public.snaptogrid(public.geometry, double precision, double precision) OWNER TO postgres;

--
-- Name: snaptogrid(public.geometry, double precision, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.snaptogrid(public.geometry, double precision, double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_snaptogrid';


ALTER FUNCTION public.snaptogrid(public.geometry, double precision, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: snaptogrid(public.geometry, public.geometry, double precision, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.snaptogrid(public.geometry, public.geometry, double precision, double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_snaptogrid_pointoff';


ALTER FUNCTION public.snaptogrid(public.geometry, public.geometry, double precision, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: srid(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.srid(public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_get_srid';


ALTER FUNCTION public.srid(public.geometry) OWNER TO postgres;

--
-- Name: st_asbinary(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_asbinary(text) RETURNS bytea
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$ SELECT ST_AsBinary($1::geometry);$_$;


ALTER FUNCTION public.st_asbinary(text) OWNER TO postgres;

--
-- Name: st_astext(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_astext(bytea) RETURNS text
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$ SELECT ST_AsText($1::geometry);$_$;


ALTER FUNCTION public.st_astext(bytea) OWNER TO postgres;

--
-- Name: st_box(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_box(public.box3d) RETURNS box
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_to_BOX';


ALTER FUNCTION public.st_box(public.box3d) OWNER TO postgres;

--
-- Name: st_box(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_box(public.geometry) RETURNS box
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_to_BOX';


ALTER FUNCTION public.st_box(public.geometry) OWNER TO postgres;

--
-- Name: st_box2d(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_box2d(public.box3d) RETURNS public.box2d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_to_BOX2D';


ALTER FUNCTION public.st_box2d(public.box3d) OWNER TO postgres;

--
-- Name: st_box2d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_box2d(public.geometry) RETURNS public.box2d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_to_BOX2D';


ALTER FUNCTION public.st_box2d(public.geometry) OWNER TO postgres;

--
-- Name: st_box3d(public.box2d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_box3d(public.box2d) RETURNS public.box3d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX2D_to_BOX3D';


ALTER FUNCTION public.st_box3d(public.box2d) OWNER TO postgres;

--
-- Name: st_box3d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_box3d(public.geometry) RETURNS public.box3d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_to_BOX3D';


ALTER FUNCTION public.st_box3d(public.geometry) OWNER TO postgres;

--
-- Name: st_box3d_in(cstring); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_box3d_in(cstring) RETURNS public.box3d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_in';


ALTER FUNCTION public.st_box3d_in(cstring) OWNER TO postgres;

--
-- Name: st_box3d_out(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_box3d_out(public.box3d) RETURNS cstring
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_out';


ALTER FUNCTION public.st_box3d_out(public.box3d) OWNER TO postgres;

--
-- Name: st_bytea(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_bytea(public.geometry) RETURNS bytea
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_to_bytea';


ALTER FUNCTION public.st_bytea(public.geometry) OWNER TO postgres;

--
-- Name: st_geometry(bytea); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry(bytea) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_from_bytea';


ALTER FUNCTION public.st_geometry(bytea) OWNER TO postgres;

--
-- Name: st_geometry(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry(text) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'parse_WKT_lwgeom';


ALTER FUNCTION public.st_geometry(text) OWNER TO postgres;

--
-- Name: st_geometry(public.box2d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry(public.box2d) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX2D_to_LWGEOM';


ALTER FUNCTION public.st_geometry(public.box2d) OWNER TO postgres;

--
-- Name: st_geometry(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry(public.box3d) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_to_LWGEOM';


ALTER FUNCTION public.st_geometry(public.box3d) OWNER TO postgres;

--
-- Name: st_geometry_cmp(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry_cmp(public.geometry, public.geometry) RETURNS integer
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'lwgeom_cmp';


ALTER FUNCTION public.st_geometry_cmp(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: st_geometry_eq(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry_eq(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'lwgeom_eq';


ALTER FUNCTION public.st_geometry_eq(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: st_geometry_ge(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry_ge(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'lwgeom_ge';


ALTER FUNCTION public.st_geometry_ge(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: st_geometry_gt(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry_gt(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'lwgeom_gt';


ALTER FUNCTION public.st_geometry_gt(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: st_geometry_le(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry_le(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'lwgeom_le';


ALTER FUNCTION public.st_geometry_le(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: st_geometry_lt(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_geometry_lt(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'lwgeom_lt';


ALTER FUNCTION public.st_geometry_lt(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: st_length3d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_length3d(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_length_linestring';


ALTER FUNCTION public.st_length3d(public.geometry) OWNER TO postgres;

--
-- Name: st_length_spheroid3d(public.geometry, public.spheroid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_length_spheroid3d(public.geometry, public.spheroid) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'LWGEOM_length_ellipsoid_linestring';


ALTER FUNCTION public.st_length_spheroid3d(public.geometry, public.spheroid) OWNER TO postgres;

--
-- Name: st_makebox3d(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_makebox3d(public.geometry, public.geometry) RETURNS public.box3d
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_construct';


ALTER FUNCTION public.st_makebox3d(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: st_makeline_garray(public.geometry[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_makeline_garray(public.geometry[]) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_makeline_garray';


ALTER FUNCTION public.st_makeline_garray(public.geometry[]) OWNER TO postgres;

--
-- Name: st_perimeter3d(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_perimeter3d(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_perimeter_poly';


ALTER FUNCTION public.st_perimeter3d(public.geometry) OWNER TO postgres;

--
-- Name: st_polygonize_garray(public.geometry[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_polygonize_garray(public.geometry[]) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT COST 100
    AS '$libdir/postgis-2.0', 'polygonize_garray';


ALTER FUNCTION public.st_polygonize_garray(public.geometry[]) OWNER TO postgres;

--
-- Name: st_text(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_text(public.geometry) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_to_text';


ALTER FUNCTION public.st_text(public.geometry) OWNER TO postgres;

--
-- Name: st_unite_garray(public.geometry[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.st_unite_garray(public.geometry[]) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'pgis_union_geometry_array';


ALTER FUNCTION public.st_unite_garray(public.geometry[]) OWNER TO postgres;

--
-- Name: startpoint(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.startpoint(public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_startpoint_linestring';


ALTER FUNCTION public.startpoint(public.geometry) OWNER TO postgres;

--
-- Name: summary(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.summary(public.geometry) RETURNS text
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_summary';


ALTER FUNCTION public.summary(public.geometry) OWNER TO postgres;

--
-- Name: symdifference(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.symdifference(public.geometry, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'symdifference';


ALTER FUNCTION public.symdifference(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: symmetricdifference(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.symmetricdifference(public.geometry, public.geometry) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'symdifference';


ALTER FUNCTION public.symmetricdifference(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: touches(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.touches(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'touches';


ALTER FUNCTION public.touches(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: transform(public.geometry, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.transform(public.geometry, integer) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'transform';


ALTER FUNCTION public.transform(public.geometry, integer) OWNER TO postgres;

--
-- Name: translate(public.geometry, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.translate(public.geometry, double precision, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_translate($1, $2, $3, 0)$_$;


ALTER FUNCTION public.translate(public.geometry, double precision, double precision) OWNER TO postgres;

--
-- Name: translate(public.geometry, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.translate(public.geometry, double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_affine($1, 1, 0, 0, 0, 1, 0, 0, 0, 1, $2, $3, $4)$_$;


ALTER FUNCTION public.translate(public.geometry, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: transscale(public.geometry, double precision, double precision, double precision, double precision); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.transscale(public.geometry, double precision, double precision, double precision, double precision) RETURNS public.geometry
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT st_affine($1,  $4, 0, 0,  0, $5, 0,
		0, 0, 1,  $2 * $4, $3 * $5, 0)$_$;


ALTER FUNCTION public.transscale(public.geometry, double precision, double precision, double precision, double precision) OWNER TO postgres;

--
-- Name: unite_garray(public.geometry[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.unite_garray(public.geometry[]) RETURNS public.geometry
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'pgis_union_geometry_array';


ALTER FUNCTION public.unite_garray(public.geometry[]) OWNER TO postgres;

--
-- Name: within(public.geometry, public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.within(public.geometry, public.geometry) RETURNS boolean
    LANGUAGE sql IMMUTABLE STRICT
    AS $_$SELECT ST_Within($1, $2)$_$;


ALTER FUNCTION public.within(public.geometry, public.geometry) OWNER TO postgres;

--
-- Name: x(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.x(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_x_point';


ALTER FUNCTION public.x(public.geometry) OWNER TO postgres;

--
-- Name: xmax(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.xmax(public.box3d) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_xmax';


ALTER FUNCTION public.xmax(public.box3d) OWNER TO postgres;

--
-- Name: xmin(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.xmin(public.box3d) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_xmin';


ALTER FUNCTION public.xmin(public.box3d) OWNER TO postgres;

--
-- Name: y(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.y(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_y_point';


ALTER FUNCTION public.y(public.geometry) OWNER TO postgres;

--
-- Name: ymax(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ymax(public.box3d) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_ymax';


ALTER FUNCTION public.ymax(public.box3d) OWNER TO postgres;

--
-- Name: ymin(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.ymin(public.box3d) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_ymin';


ALTER FUNCTION public.ymin(public.box3d) OWNER TO postgres;

--
-- Name: z(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.z(public.geometry) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_z_point';


ALTER FUNCTION public.z(public.geometry) OWNER TO postgres;

--
-- Name: zmax(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.zmax(public.box3d) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_zmax';


ALTER FUNCTION public.zmax(public.box3d) OWNER TO postgres;

--
-- Name: zmflag(public.geometry); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.zmflag(public.geometry) RETURNS smallint
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'LWGEOM_zmflag';


ALTER FUNCTION public.zmflag(public.geometry) OWNER TO postgres;

--
-- Name: zmin(public.box3d); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.zmin(public.box3d) RETURNS double precision
    LANGUAGE c IMMUTABLE STRICT
    AS '$libdir/postgis-2.0', 'BOX3D_zmin';


ALTER FUNCTION public.zmin(public.box3d) OWNER TO postgres;

--
-- Name: accum(public.geometry); Type: AGGREGATE; Schema: public; Owner: postgres
--

CREATE AGGREGATE public.accum(public.geometry) (
    SFUNC = public.pgis_geometry_accum_transfn,
    STYPE = public.pgis_abs,
    FINALFUNC = public.pgis_geometry_accum_finalfn
);


ALTER AGGREGATE public.accum(public.geometry) OWNER TO postgres;

--
-- Name: extent(public.geometry); Type: AGGREGATE; Schema: public; Owner: postgres
--

CREATE AGGREGATE public.extent(public.geometry) (
    SFUNC = public.st_combine_bbox,
    STYPE = public.box3d,
    FINALFUNC = public.box2d
);


ALTER AGGREGATE public.extent(public.geometry) OWNER TO postgres;

--
-- Name: extent3d(public.geometry); Type: AGGREGATE; Schema: public; Owner: postgres
--

CREATE AGGREGATE public.extent3d(public.geometry) (
    SFUNC = public.combine_bbox,
    STYPE = public.box3d
);


ALTER AGGREGATE public.extent3d(public.geometry) OWNER TO postgres;

--
-- Name: makeline(public.geometry); Type: AGGREGATE; Schema: public; Owner: postgres
--

CREATE AGGREGATE public.makeline(public.geometry) (
    SFUNC = public.pgis_geometry_accum_transfn,
    STYPE = public.pgis_abs,
    FINALFUNC = public.pgis_geometry_makeline_finalfn
);


ALTER AGGREGATE public.makeline(public.geometry) OWNER TO postgres;

--
-- Name: memcollect(public.geometry); Type: AGGREGATE; Schema: public; Owner: postgres
--

CREATE AGGREGATE public.memcollect(public.geometry) (
    SFUNC = public.st_collect,
    STYPE = public.geometry
);


ALTER AGGREGATE public.memcollect(public.geometry) OWNER TO postgres;

--
-- Name: memgeomunion(public.geometry); Type: AGGREGATE; Schema: public; Owner: postgres
--

CREATE AGGREGATE public.memgeomunion(public.geometry) (
    SFUNC = public.geomunion,
    STYPE = public.geometry
);


ALTER AGGREGATE public.memgeomunion(public.geometry) OWNER TO postgres;

--
-- Name: st_extent3d(public.geometry); Type: AGGREGATE; Schema: public; Owner: postgres
--

CREATE AGGREGATE public.st_extent3d(public.geometry) (
    SFUNC = public.st_combine_bbox,
    STYPE = public.box3d
);


ALTER AGGREGATE public.st_extent3d(public.geometry) OWNER TO postgres;

SET default_tablespace = '';

--
-- Name: auditoria_usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditoria_usuarios (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    fecha timestamp without time zone DEFAULT now()
);


ALTER TABLE public.auditoria_usuarios OWNER TO postgres;

--
-- Name: auditoria_usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoria_usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auditoria_usuarios_id_seq OWNER TO postgres;

--
-- Name: auditoria_usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoria_usuarios_id_seq OWNED BY public.auditoria_usuarios.id;


--
-- Name: auditoriaaccidente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditoriaaccidente (
    au_acc_id integer NOT NULL,
    au_acc_fechah timestamp without time zone,
    au_acc_desc text NOT NULL,
    au_acc_estadoini integer NOT NULL,
    au_acc_estadofin integer NOT NULL,
    reg_acc_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.auditoriaaccidente OWNER TO postgres;

--
-- Name: auditoriaaccidente_au_acc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoriaaccidente_au_acc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auditoriaaccidente_au_acc_id_seq OWNER TO postgres;

--
-- Name: auditoriaaccidente_au_acc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoriaaccidente_au_acc_id_seq OWNED BY public.auditoriaaccidente.au_acc_id;


--
-- Name: auditoriareddan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditoriareddan (
    au_red_dan_id integer NOT NULL,
    au_red_dan_fechah timestamp without time zone,
    au_red_dan_desc text NOT NULL,
    au_red_dan_estadoini integer NOT NULL,
    au_red_dan_estadofin integer NOT NULL,
    sol_red_dan_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.auditoriareddan OWNER TO postgres;

--
-- Name: auditoriareddan_au_red_dan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoriareddan_au_red_dan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auditoriareddan_au_red_dan_id_seq OWNER TO postgres;

--
-- Name: auditoriareddan_au_red_dan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoriareddan_au_red_dan_id_seq OWNED BY public.auditoriareddan.au_red_dan_id;


--
-- Name: auditoriarednew; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditoriarednew (
    au_red_new_id integer NOT NULL,
    au_red_new_fechah timestamp without time zone,
    au_red_new_desc text NOT NULL,
    au_red_new_estadoini integer NOT NULL,
    au_red_new_estadofin integer NOT NULL,
    sol_red_new_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.auditoriarednew OWNER TO postgres;

--
-- Name: auditoriarednew_au_red_new_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoriarednew_au_red_new_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auditoriarednew_au_red_new_id_seq OWNER TO postgres;

--
-- Name: auditoriarednew_au_red_new_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoriarednew_au_red_new_id_seq OWNED BY public.auditoriarednew.au_red_new_id;


--
-- Name: auditoriasendan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditoriasendan (
    au_sen_dan_id integer NOT NULL,
    au_sen_dan_fechah timestamp without time zone,
    au_sen_dan_desc text NOT NULL,
    au_sen_dan_estadoini integer NOT NULL,
    au_sen_dan_estadofin integer NOT NULL,
    sol_sen_dan_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.auditoriasendan OWNER TO postgres;

--
-- Name: auditoriasendan_au_sen_dan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoriasendan_au_sen_dan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auditoriasendan_au_sen_dan_id_seq OWNER TO postgres;

--
-- Name: auditoriasendan_au_sen_dan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoriasendan_au_sen_dan_id_seq OWNED BY public.auditoriasendan.au_sen_dan_id;


--
-- Name: auditoriasennew; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditoriasennew (
    au_sen_new_id integer NOT NULL,
    au_sen_new_fechah timestamp without time zone,
    au_sen_new_desc text NOT NULL,
    au_sen_new_estadoini integer NOT NULL,
    au_sen_new_estadofin integer NOT NULL,
    sol_sen_new_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.auditoriasennew OWNER TO postgres;

--
-- Name: auditoriasennew_au_sen_new_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoriasennew_au_sen_new_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auditoriasennew_au_sen_new_id_seq OWNER TO postgres;

--
-- Name: auditoriasennew_au_sen_new_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoriasennew_au_sen_new_id_seq OWNED BY public.auditoriasennew.au_sen_new_id;


--
-- Name: auditoriavia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auditoriavia (
    au_via_id integer NOT NULL,
    au_via_fechah timestamp without time zone,
    au_via_desc text NOT NULL,
    au_via_estadoini integer NOT NULL,
    au_via_estadofin integer NOT NULL,
    sol_via_dan_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.auditoriavia OWNER TO postgres;

--
-- Name: auditoriavia_au_via_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.auditoriavia_au_via_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.auditoriavia_au_via_id_seq OWNER TO postgres;

--
-- Name: auditoriavia_au_via_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.auditoriavia_au_via_id_seq OWNED BY public.auditoriavia.au_via_id;


--
-- Name: categoria_reductores; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categoria_reductores (
    id_categoria integer NOT NULL,
    nombre_categoria character varying(100) NOT NULL
);


ALTER TABLE public.categoria_reductores OWNER TO postgres;

--
-- Name: categoria_reductores_id_categoria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categoria_reductores_id_categoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categoria_reductores_id_categoria_seq OWNER TO postgres;

--
-- Name: categoria_reductores_id_categoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categoria_reductores_id_categoria_seq OWNED BY public.categoria_reductores.id_categoria;


--
-- Name: categoria_seniales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categoria_seniales (
    categoria_seniales_id integer NOT NULL,
    categoria_seniales_desc character varying(40) NOT NULL
);


ALTER TABLE public.categoria_seniales OWNER TO postgres;

--
-- Name: categoria_seniales_categoria_seniales_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categoria_seniales_categoria_seniales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categoria_seniales_categoria_seniales_id_seq OWNER TO postgres;

--
-- Name: categoria_seniales_categoria_seniales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categoria_seniales_categoria_seniales_id_seq OWNED BY public.categoria_seniales.categoria_seniales_id;


--
-- Name: choque_detalle; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.choque_detalle (
    choq_detal_id integer NOT NULL,
    descripcion character varying(80),
    id_perteneciente integer
);


ALTER TABLE public.choque_detalle OWNER TO postgres;

--
-- Name: danio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.danio (
    danio_id integer NOT NULL,
    tipo_danio_id integer,
    solicitud_id integer
);


ALTER TABLE public.danio OWNER TO postgres;

--
-- Name: estados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estados (
    est_id integer NOT NULL,
    est_nombre character varying
);


ALTER TABLE public.estados OWNER TO postgres;

--
-- Name: estados_est_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.estados_est_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.estados_est_id_seq OWNER TO postgres;

--
-- Name: estados_est_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.estados_est_id_seq OWNED BY public.estados.est_id;


--
-- Name: imagenes_accidente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.imagenes_accidente (
    img_id integer NOT NULL,
    reg_acc_id integer NOT NULL,
    img_ruta character varying
);


ALTER TABLE public.imagenes_accidente OWNER TO postgres;

--
-- Name: imagenes_vias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.imagenes_vias (
    img_id integer NOT NULL,
    reg_via_id integer NOT NULL,
    img_ruta character varying NOT NULL
);


ALTER TABLE public.imagenes_vias OWNER TO postgres;

--
-- Name: orientacion_seniales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.orientacion_seniales (
    orientacion_id integer NOT NULL,
    orientacion_desc character varying(50) NOT NULL
);


ALTER TABLE public.orientacion_seniales OWNER TO postgres;

--
-- Name: orientacion_seniales_orientacion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.orientacion_seniales_orientacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.orientacion_seniales_orientacion_id_seq OWNER TO postgres;

--
-- Name: orientacion_seniales_orientacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.orientacion_seniales_orientacion_id_seq OWNED BY public.orientacion_seniales.orientacion_id;


--
-- Name: pqrs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pqrs (
    id_pqrs integer NOT NULL,
    desc_pqrs text NOT NULL,
    tipo_pqrs integer,
    usu_id integer,
    fecha_hora timestamp without time zone NOT NULL
);


ALTER TABLE public.pqrs OWNER TO postgres;

--
-- Name: pqrs_id_pqrs_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pqrs_id_pqrs_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pqrs_id_pqrs_seq OWNER TO postgres;

--
-- Name: pqrs_id_pqrs_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pqrs_id_pqrs_seq OWNED BY public.pqrs.id_pqrs;


--
-- Name: punto_accidente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.punto_accidente (
    id integer NOT NULL,
    id_accidente integer NOT NULL,
    geom public.geometry(Point,4326)
);


ALTER TABLE public.punto_accidente OWNER TO postgres;

--
-- Name: punto_accidente_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.punto_accidente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.punto_accidente_id_seq OWNER TO postgres;

--
-- Name: punto_accidente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.punto_accidente_id_seq OWNED BY public.punto_accidente.id;


--
-- Name: punto_reductordan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.punto_reductordan (
    id_red_dan integer NOT NULL,
    id_reductordan integer NOT NULL,
    geom public.geometry(Point,4326)
);


ALTER TABLE public.punto_reductordan OWNER TO postgres;

--
-- Name: punto_reductordan_id_red_dan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.punto_reductordan_id_red_dan_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.punto_reductordan_id_red_dan_seq OWNER TO postgres;

--
-- Name: punto_reductordan_id_red_dan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.punto_reductordan_id_red_dan_seq OWNED BY public.punto_reductordan.id_red_dan;


--
-- Name: punto_reductornew; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.punto_reductornew (
    id_red_new integer NOT NULL,
    id_reductornew integer NOT NULL,
    geom public.geometry(Point,4326)
);


ALTER TABLE public.punto_reductornew OWNER TO postgres;

--
-- Name: punto_reductornew_id_red_new_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.punto_reductornew_id_red_new_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.punto_reductornew_id_red_new_seq OWNER TO postgres;

--
-- Name: punto_reductornew_id_red_new_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.punto_reductornew_id_red_new_seq OWNED BY public.punto_reductornew.id_red_new;


--
-- Name: punto_senialdan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.punto_senialdan (
    id integer NOT NULL,
    id_senialdan integer NOT NULL,
    geom public.geometry(Point,4326)
);


ALTER TABLE public.punto_senialdan OWNER TO postgres;

--
-- Name: punto_senialdan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.punto_senialdan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.punto_senialdan_id_seq OWNER TO postgres;

--
-- Name: punto_senialdan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.punto_senialdan_id_seq OWNED BY public.punto_senialdan.id;


--
-- Name: punto_senialnew; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.punto_senialnew (
    id integer NOT NULL,
    id_senialnew integer NOT NULL,
    geom public.geometry(Point,4326)
);


ALTER TABLE public.punto_senialnew OWNER TO postgres;

--
-- Name: punto_senialnew_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.punto_senialnew_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.punto_senialnew_id_seq OWNER TO postgres;

--
-- Name: punto_senialnew_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.punto_senialnew_id_seq OWNED BY public.punto_senialnew.id;


--
-- Name: punto_via; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.punto_via (
    id integer NOT NULL,
    id_via integer NOT NULL,
    geom public.geometry(Point,4326)
);


ALTER TABLE public.punto_via OWNER TO postgres;

--
-- Name: punto_via_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.punto_via_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.punto_via_id_seq OWNER TO postgres;

--
-- Name: punto_via_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.punto_via_id_seq OWNED BY public.punto_via.id;


--
-- Name: reg_acc_vehi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reg_acc_vehi (
    reg_acc_vehi_id integer NOT NULL,
    reg_acc_id integer NOT NULL,
    vehiculo_id integer NOT NULL
);


ALTER TABLE public.reg_acc_vehi OWNER TO postgres;

--
-- Name: registro_accidente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.registro_accidente (
    reg_acc_id integer NOT NULL,
    reg_acc_fecha_hora timestamp without time zone NOT NULL,
    tipo_accidente_id integer NOT NULL,
    reg_acc_lesionados boolean NOT NULL,
    reg_acc_observaciones text NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.registro_accidente OWNER TO postgres;

--
-- Name: registro_accidente_reg_acc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.registro_accidente_reg_acc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.registro_accidente_reg_acc_id_seq OWNER TO postgres;

--
-- Name: registro_accidente_reg_acc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.registro_accidente_reg_acc_id_seq OWNED BY public.registro_accidente.reg_acc_id;


--
-- Name: registro_detalle_accidente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.registro_detalle_accidente (
    reg_det_acc_id integer NOT NULL,
    reg_acc_id integer NOT NULL,
    choque_detalle_id integer NOT NULL
);


ALTER TABLE public.registro_detalle_accidente OWNER TO postgres;

--
-- Name: rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rol (
    rol_id integer NOT NULL,
    rol_nombre character varying(30)
);


ALTER TABLE public.rol OWNER TO postgres;

--
-- Name: rol_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rol_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rol_rol_id_seq OWNER TO postgres;

--
-- Name: rol_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rol_rol_id_seq OWNED BY public.rol.rol_id;


--
-- Name: sexo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sexo (
    sex_id integer NOT NULL,
    sex_desc character varying(50)
);


ALTER TABLE public.sexo OWNER TO postgres;

--
-- Name: sexo_sex_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sexo_sex_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sexo_sex_id_seq OWNER TO postgres;

--
-- Name: sexo_sex_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sexo_sex_id_seq OWNED BY public.sexo.sex_id;


--
-- Name: solicitud_reductores_dan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitud_reductores_dan (
    sol_red_dan_id integer NOT NULL,
    tipo_red_id integer NOT NULL,
    danio_id integer NOT NULL,
    desc_red text,
    sol_red_dan_fecha timestamp without time zone,
    img_red_dan text,
    est_sol_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.solicitud_reductores_dan OWNER TO postgres;

--
-- Name: solicitud_reductores_dan_sol_red_dan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitud_reductores_dan_sol_red_dan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.solicitud_reductores_dan_sol_red_dan_id_seq OWNER TO postgres;

--
-- Name: solicitud_reductores_dan_sol_red_dan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitud_reductores_dan_sol_red_dan_id_seq OWNED BY public.solicitud_reductores_dan.sol_red_dan_id;


--
-- Name: solicitud_reductores_new; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitud_reductores_new (
    sol_red_new_id integer NOT NULL,
    tipo_red_id integer NOT NULL,
    desc_red_new text,
    sol_red_new_fecha timestamp without time zone,
    img_red_new text,
    est_sol_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.solicitud_reductores_new OWNER TO postgres;

--
-- Name: solicitud_reductores_new_sol_red_new_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitud_reductores_new_sol_red_new_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.solicitud_reductores_new_sol_red_new_id_seq OWNER TO postgres;

--
-- Name: solicitud_reductores_new_sol_red_new_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitud_reductores_new_sol_red_new_id_seq OWNED BY public.solicitud_reductores_new.sol_red_new_id;


--
-- Name: solicitud_seniales_dan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitud_seniales_dan (
    sol_sen_dan_id integer NOT NULL,
    tipo_sen_id integer NOT NULL,
    desc_sen_dan text NOT NULL,
    danio_id integer NOT NULL,
    sol_sen_dan_fecha timestamp without time zone,
    img_sen_dan text,
    est_sol_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.solicitud_seniales_dan OWNER TO postgres;

--
-- Name: solicitud_seniales_dan_sol_sen_dan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitud_seniales_dan_sol_sen_dan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.solicitud_seniales_dan_sol_sen_dan_id_seq OWNER TO postgres;

--
-- Name: solicitud_seniales_dan_sol_sen_dan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitud_seniales_dan_sol_sen_dan_id_seq OWNED BY public.solicitud_seniales_dan.sol_sen_dan_id;


--
-- Name: solicitud_seniales_new; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitud_seniales_new (
    sol_sen_new_id integer NOT NULL,
    tipo_sen_id integer NOT NULL,
    desc_sen text NOT NULL,
    sol_sen_new_fecha timestamp without time zone,
    est_sol_id integer NOT NULL,
    usu_id integer NOT NULL
);


ALTER TABLE public.solicitud_seniales_new OWNER TO postgres;

--
-- Name: solicitud_seniales_new_sol_sen_new_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitud_seniales_new_sol_sen_new_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.solicitud_seniales_new_sol_sen_new_id_seq OWNER TO postgres;

--
-- Name: solicitud_seniales_new_sol_sen_new_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitud_seniales_new_sol_sen_new_id_seq OWNED BY public.solicitud_seniales_new.sol_sen_new_id;


--
-- Name: solicitud_via_dan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitud_via_dan (
    sol_via_dan_id integer NOT NULL,
    tipo_dano_via_id integer,
    descripcion_via text,
    fecha_hora timestamp without time zone NOT NULL,
    est_sol_id integer,
    usu_id integer,
    via_id integer
);


ALTER TABLE public.solicitud_via_dan OWNER TO postgres;

--
-- Name: tipo_choque; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_choque (
    tipo_choque_id integer NOT NULL,
    tipo_choque_desc character varying
);


ALTER TABLE public.tipo_choque OWNER TO postgres;

--
-- Name: tipo_danio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_danio (
    tipo_danio_id integer NOT NULL,
    tipo_danio_desc character varying(100)
);


ALTER TABLE public.tipo_danio OWNER TO postgres;

--
-- Name: tipo_danio_tipo_danio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_danio_tipo_danio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipo_danio_tipo_danio_id_seq OWNER TO postgres;

--
-- Name: tipo_danio_tipo_danio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_danio_tipo_danio_id_seq OWNED BY public.tipo_danio.tipo_danio_id;


--
-- Name: tipo_documento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_documento (
    doc_id integer NOT NULL,
    nombre_tipo character varying,
    doc_abrev character varying(4)
);


ALTER TABLE public.tipo_documento OWNER TO postgres;

--
-- Name: tipo_documento_doc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_documento_doc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipo_documento_doc_id_seq OWNER TO postgres;

--
-- Name: tipo_documento_doc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_documento_doc_id_seq OWNED BY public.tipo_documento.doc_id;


--
-- Name: tipo_estado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_estado (
    id_tipo_estado integer NOT NULL,
    id_estado integer,
    id_perteneciente integer
);


ALTER TABLE public.tipo_estado OWNER TO postgres;

--
-- Name: tipo_estado_id_tipo_estado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_estado_id_tipo_estado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipo_estado_id_tipo_estado_seq OWNER TO postgres;

--
-- Name: tipo_estado_id_tipo_estado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_estado_id_tipo_estado_seq OWNED BY public.tipo_estado.id_tipo_estado;


--
-- Name: tipo_pqrs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_pqrs (
    id_tipo_pqrs integer NOT NULL,
    desc_tipo_pqrs character varying(50) NOT NULL
);


ALTER TABLE public.tipo_pqrs OWNER TO postgres;

--
-- Name: tipo_pqrs_id_tipo_pqrs_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_pqrs_id_tipo_pqrs_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipo_pqrs_id_tipo_pqrs_seq OWNER TO postgres;

--
-- Name: tipo_pqrs_id_tipo_pqrs_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_pqrs_id_tipo_pqrs_seq OWNED BY public.tipo_pqrs.id_tipo_pqrs;


--
-- Name: tipo_seniales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_seniales (
    tipo_senial_id integer NOT NULL,
    tipo_sen_desc character varying(100) NOT NULL,
    desc_sen text,
    img_sen text,
    orientacion_id integer NOT NULL,
    cat_id integer NOT NULL
);


ALTER TABLE public.tipo_seniales OWNER TO postgres;

--
-- Name: tipo_seniales_tipo_senial_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_seniales_tipo_senial_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipo_seniales_tipo_senial_id_seq OWNER TO postgres;

--
-- Name: tipo_seniales_tipo_senial_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_seniales_tipo_senial_id_seq OWNED BY public.tipo_seniales.tipo_senial_id;


--
-- Name: tipo_via; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_via (
    id_tipo_via integer NOT NULL,
    desc_via character varying
);


ALTER TABLE public.tipo_via OWNER TO postgres;

--
-- Name: tipo_via_id_tipo_via_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_via_id_tipo_via_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipo_via_id_tipo_via_seq OWNER TO postgres;

--
-- Name: tipo_via_id_tipo_via_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_via_id_tipo_via_seq OWNED BY public.tipo_via.id_tipo_via;


--
-- Name: tipos_reductores; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipos_reductores (
    tipo_red_id integer NOT NULL,
    nombre_tipo_red character varying(100) NOT NULL,
    descripcion_tipo_red text,
    img_reductor text,
    cat_id integer
);


ALTER TABLE public.tipos_reductores OWNER TO postgres;

--
-- Name: tipos_reductores_tipo_red_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipos_reductores_tipo_red_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipos_reductores_tipo_red_id_seq OWNER TO postgres;

--
-- Name: tipos_reductores_tipo_red_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipos_reductores_tipo_red_id_seq OWNED BY public.tipos_reductores.tipo_red_id;


--
-- Name: tokens_contra; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tokens_contra (
    id_token integer NOT NULL,
    token character varying(6) NOT NULL,
    usu_id integer NOT NULL,
    expiracion timestamp without time zone NOT NULL
);


ALTER TABLE public.tokens_contra OWNER TO postgres;

--
-- Name: tokens_contra_id_token_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tokens_contra_id_token_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tokens_contra_id_token_seq OWNER TO postgres;

--
-- Name: tokens_contra_id_token_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tokens_contra_id_token_seq OWNED BY public.tokens_contra.id_token;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    usu_id integer NOT NULL,
    usu_documento character varying(50) NOT NULL,
    usu_nombre1 character varying(50) NOT NULL,
    usu_nombre2 character varying(50),
    usu_apellido1 character varying(50) NOT NULL,
    usu_apellido2 character varying(50),
    usu_correo character varying(50) NOT NULL,
    usu_clave character varying(255) NOT NULL,
    usu_tel character varying(50) NOT NULL,
    usu_direccion character varying(500) NOT NULL,
    rol_id integer,
    est_id integer,
    doc_id integer,
    sex_id integer
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuarios_usu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_usu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_usu_id_seq OWNER TO postgres;

--
-- Name: usuarios_usu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_usu_id_seq OWNED BY public.usuarios.usu_id;


--
-- Name: vehiculo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vehiculo (
    vehiculo_id integer NOT NULL,
    vehiculo_descripcion character varying(30) NOT NULL
);


ALTER TABLE public.vehiculo OWNER TO postgres;

--
-- Name: auditoria_usuarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoria_usuarios ALTER COLUMN id SET DEFAULT nextval('public.auditoria_usuarios_id_seq'::regclass);


--
-- Name: auditoriaaccidente au_acc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriaaccidente ALTER COLUMN au_acc_id SET DEFAULT nextval('public.auditoriaaccidente_au_acc_id_seq'::regclass);


--
-- Name: auditoriareddan au_red_dan_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriareddan ALTER COLUMN au_red_dan_id SET DEFAULT nextval('public.auditoriareddan_au_red_dan_id_seq'::regclass);


--
-- Name: auditoriarednew au_red_new_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriarednew ALTER COLUMN au_red_new_id SET DEFAULT nextval('public.auditoriarednew_au_red_new_id_seq'::regclass);


--
-- Name: auditoriasendan au_sen_dan_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriasendan ALTER COLUMN au_sen_dan_id SET DEFAULT nextval('public.auditoriasendan_au_sen_dan_id_seq'::regclass);


--
-- Name: auditoriasennew au_sen_new_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriasennew ALTER COLUMN au_sen_new_id SET DEFAULT nextval('public.auditoriasennew_au_sen_new_id_seq'::regclass);


--
-- Name: auditoriavia au_via_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriavia ALTER COLUMN au_via_id SET DEFAULT nextval('public.auditoriavia_au_via_id_seq'::regclass);


--
-- Name: categoria_reductores id_categoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categoria_reductores ALTER COLUMN id_categoria SET DEFAULT nextval('public.categoria_reductores_id_categoria_seq'::regclass);


--
-- Name: categoria_seniales categoria_seniales_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categoria_seniales ALTER COLUMN categoria_seniales_id SET DEFAULT nextval('public.categoria_seniales_categoria_seniales_id_seq'::regclass);


--
-- Name: estados est_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estados ALTER COLUMN est_id SET DEFAULT nextval('public.estados_est_id_seq'::regclass);


--
-- Name: orientacion_seniales orientacion_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orientacion_seniales ALTER COLUMN orientacion_id SET DEFAULT nextval('public.orientacion_seniales_orientacion_id_seq'::regclass);


--
-- Name: pqrs id_pqrs; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pqrs ALTER COLUMN id_pqrs SET DEFAULT nextval('public.pqrs_id_pqrs_seq'::regclass);


--
-- Name: punto_accidente id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.punto_accidente ALTER COLUMN id SET DEFAULT nextval('public.punto_accidente_id_seq'::regclass);


--
-- Name: punto_reductordan id_red_dan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.punto_reductordan ALTER COLUMN id_red_dan SET DEFAULT nextval('public.punto_reductordan_id_red_dan_seq'::regclass);


--
-- Name: punto_reductornew id_red_new; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.punto_reductornew ALTER COLUMN id_red_new SET DEFAULT nextval('public.punto_reductornew_id_red_new_seq'::regclass);


--
-- Name: punto_senialdan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.punto_senialdan ALTER COLUMN id SET DEFAULT nextval('public.punto_senialdan_id_seq'::regclass);


--
-- Name: punto_senialnew id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.punto_senialnew ALTER COLUMN id SET DEFAULT nextval('public.punto_senialnew_id_seq'::regclass);


--
-- Name: punto_via id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.punto_via ALTER COLUMN id SET DEFAULT nextval('public.punto_via_id_seq'::regclass);


--
-- Name: registro_accidente reg_acc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registro_accidente ALTER COLUMN reg_acc_id SET DEFAULT nextval('public.registro_accidente_reg_acc_id_seq'::regclass);


--
-- Name: rol rol_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol ALTER COLUMN rol_id SET DEFAULT nextval('public.rol_rol_id_seq'::regclass);


--
-- Name: sexo sex_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sexo ALTER COLUMN sex_id SET DEFAULT nextval('public.sexo_sex_id_seq'::regclass);


--
-- Name: solicitud_reductores_dan sol_red_dan_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_dan ALTER COLUMN sol_red_dan_id SET DEFAULT nextval('public.solicitud_reductores_dan_sol_red_dan_id_seq'::regclass);


--
-- Name: solicitud_reductores_new sol_red_new_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_new ALTER COLUMN sol_red_new_id SET DEFAULT nextval('public.solicitud_reductores_new_sol_red_new_id_seq'::regclass);


--
-- Name: solicitud_seniales_dan sol_sen_dan_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_dan ALTER COLUMN sol_sen_dan_id SET DEFAULT nextval('public.solicitud_seniales_dan_sol_sen_dan_id_seq'::regclass);


--
-- Name: solicitud_seniales_new sol_sen_new_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_new ALTER COLUMN sol_sen_new_id SET DEFAULT nextval('public.solicitud_seniales_new_sol_sen_new_id_seq'::regclass);


--
-- Name: tipo_danio tipo_danio_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_danio ALTER COLUMN tipo_danio_id SET DEFAULT nextval('public.tipo_danio_tipo_danio_id_seq'::regclass);


--
-- Name: tipo_documento doc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_documento ALTER COLUMN doc_id SET DEFAULT nextval('public.tipo_documento_doc_id_seq'::regclass);


--
-- Name: tipo_estado id_tipo_estado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_estado ALTER COLUMN id_tipo_estado SET DEFAULT nextval('public.tipo_estado_id_tipo_estado_seq'::regclass);


--
-- Name: tipo_pqrs id_tipo_pqrs; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_pqrs ALTER COLUMN id_tipo_pqrs SET DEFAULT nextval('public.tipo_pqrs_id_tipo_pqrs_seq'::regclass);


--
-- Name: tipo_seniales tipo_senial_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_seniales ALTER COLUMN tipo_senial_id SET DEFAULT nextval('public.tipo_seniales_tipo_senial_id_seq'::regclass);


--
-- Name: tipo_via id_tipo_via; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_via ALTER COLUMN id_tipo_via SET DEFAULT nextval('public.tipo_via_id_tipo_via_seq'::regclass);


--
-- Name: tipos_reductores tipo_red_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_reductores ALTER COLUMN tipo_red_id SET DEFAULT nextval('public.tipos_reductores_tipo_red_id_seq'::regclass);


--
-- Name: tokens_contra id_token; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tokens_contra ALTER COLUMN id_token SET DEFAULT nextval('public.tokens_contra_id_token_seq'::regclass);


--
-- Name: usuarios usu_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN usu_id SET DEFAULT nextval('public.usuarios_usu_id_seq'::regclass);


--
-- Data for Name: auditoria_usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditoria_usuarios (id, usuario_id, fecha) FROM stdin;
1	2	2025-01-09 16:03:33.595
\.


--
-- Data for Name: auditoriaaccidente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditoriaaccidente (au_acc_id, au_acc_fechah, au_acc_desc, au_acc_estadoini, au_acc_estadofin, reg_acc_id, usu_id) FROM stdin;
\.


--
-- Data for Name: auditoriareddan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditoriareddan (au_red_dan_id, au_red_dan_fechah, au_red_dan_desc, au_red_dan_estadoini, au_red_dan_estadofin, sol_red_dan_id, usu_id) FROM stdin;
1	2025-01-09 15:37:41	A ver aqui si hice?	3	5	1	1
2	2025-01-09 15:58:54	Como asi y usted porque esta asi	5	3	1	1
3	2025-01-09 15:58:54	Como asi y usted porque esta asi	5	3	1	1
4	2025-01-09 15:58:54	Como asi y usted porque esta asi	5	3	1	1
5	2025-01-09 15:58:54	Como asi y usted porque esta asi	5	3	1	1
6	2025-01-09 15:58:54	Como asi y usted porque esta asi	5	3	1	1
7	2025-01-09 15:58:54	Como asi y usted porque esta asi	5	3	1	1
8	2025-01-09 15:59:14	Ay gono	3	4	1	1
9	2025-01-10 00:20:17	y esta?	4	3	1	1
10	2025-01-10 00:20:17	y esta?	4	3	1	1
11	2025-01-10 00:20:17	y esta?	4	3	1	1
12	2025-01-10 00:37:37	oe	3	4	1	1
13	2025-01-10 00:37:37	oe	3	4	1	1
14	2025-01-10 00:37:37	oe	3	4	1	1
15	2025-01-10 00:41:46	Oe	4	6	1	1
16	2025-01-10 00:41:46	Oe	4	6	1	1
17	2025-01-10 00:41:46	Oe	4	6	1	1
18	2025-01-10 00:47:50	Ya	6	3	1	1
\.


--
-- Data for Name: auditoriarednew; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditoriarednew (au_red_new_id, au_red_new_fechah, au_red_new_desc, au_red_new_estadoini, au_red_new_estadofin, sol_red_new_id, usu_id) FROM stdin;
1	2025-01-09 15:43:20	Ahora si	3	5	1	1
2	2025-01-09 15:43:30	Melo	5	6	1	1
3	2025-01-10 00:24:56	Epa	6	3	1	1
4	2025-01-10 00:25:04	Epa mano	3	6	1	1
5	2025-01-10 00:33:11	Epa	6	3	1	1
6	2025-01-10 00:41:38	Oe	3	6	2	1
7	2025-01-10 00:41:38	Oe	3	6	2	1
8	2025-01-10 00:48:03	Melo	6	3	2	1
9	2025-01-10 00:48:03	Melo	6	3	2	1
10	2025-01-10 00:48:32	Ya	3	4	1	1
11	2025-01-10 00:48:38	Melo	3	4	2	1
\.


--
-- Data for Name: auditoriasendan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditoriasendan (au_sen_dan_id, au_sen_dan_fechah, au_sen_dan_desc, au_sen_dan_estadoini, au_sen_dan_estadofin, sol_sen_dan_id, usu_id) FROM stdin;
1	2025-01-09 09:51:25	Ya estuvo mi H	3	4	1	1
2	2025-01-09 09:51:26	Ya estuvo mi H	3	4	1	1
3	2025-01-09 09:52:00	yAAAA	4	5	1	1
4	2025-01-09 13:11:06	Melo esta si	5	7	1	1
5	2025-01-10 00:19:28	Toca cambiar eso	7	3	1	1
6	2025-01-10 00:19:28	Toca cambiar eso	7	3	1	1
7	2025-01-10 00:19:43	Melo mi bro	3	4	1	1
8	2025-01-10 00:19:43	Melo mi bro	3	4	1	1
9	2025-01-10 00:19:59	Ya	4	5	1	1
10	2025-01-10 00:19:59	Ya	4	5	1	1
11	2025-01-10 00:20:40	e	5	3	1	1
12	2025-01-10 00:20:40	e	5	3	1	1
13	2025-01-10 00:20:48	eee	3	5	1	1
14	2025-01-10 00:29:48	Sisaz	5	7	1	1
15	2025-01-10 00:29:48	Sisaz	5	7	1	1
16	2025-01-10 00:33:23	Ok	7	3	1	1
17	2025-01-10 00:33:23	Ok	7	3	1	1
18	2025-01-10 00:37:26	oe	3	4	1	1
19	2025-01-10 00:37:26	oe	3	4	1	1
20	2025-01-10 00:47:28	Si	4	3	1	1
21	2025-01-10 09:13:06	Sii	3	5	1	1
\.


--
-- Data for Name: auditoriasennew; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditoriasennew (au_sen_new_id, au_sen_new_fechah, au_sen_new_desc, au_sen_new_estadoini, au_sen_new_estadofin, sol_sen_new_id, usu_id) FROM stdin;
1	2025-01-09 09:13:13	Porque si menor	5	4	1	1
2	2025-01-09 09:28:31	Porque si menor	5	4	1	1
3	2025-01-09 09:28:36	Porque si menor	5	4	1	1
4	2025-01-09 09:28:52	Oe sisaz	4	5	1	1
5	2025-01-09 09:29:10	Oe sisaz	4	5	1	1
6	2025-01-09 09:29:56	Oe sisaz	4	5	1	1
7	2025-01-09 09:30:15	Ya o que	5	4	1	1
8	2025-01-09 09:32:04	Ya o que	5	4	1	1
9	2025-01-09 09:32:06	Ya o que	5	4	1	1
10	2025-01-09 09:33:39	Ya ahora melo	4	3	1	1
11	2025-01-09 09:34:33	Ya ahora melo	4	3	1	1
12	2025-01-09 09:35:32	Ya ahora melo	4	3	1	1
13	2025-01-09 09:37:07	OE	3	4	1	1
14	2025-01-09 09:37:53	OE	3	4	1	1
15	2025-01-09 09:38:12	POR FAVOR FUNCIONAAA	4	3	1	1
16	2025-01-09 09:39:03	Ya melo no?	3	4	1	1
17	2025-01-09 09:42:09	Ya	4	5	1	1
18	2025-01-09 09:43:07	Dale funcionaaa	5	4	1	1
19	2025-01-09 09:43:20	Dale funcionaaa	5	4	1	1
20	2025-01-09 09:43:30	Dale funcionaaa	5	3	1	1
21	2025-01-09 09:44:47	Ya meló	3	4	1	1
22	2025-01-09 09:52:12	mELOOO	4	5	1	1
23	2025-01-09 09:52:12	mELOOO	4	5	1	1
24	2025-01-09 10:00:21	Melo	5	4	1	1
25	2025-01-09 10:00:21	Melo	5	4	1	1
26	2025-01-09 10:07:22	R mano	4	3	1	1
27	2025-01-09 10:51:20	R	3	4	1	1
28	2025-01-10 00:20:28	a ver	4	3	1	1
29	2025-01-10 00:20:33	si	3	6	1	1
30	2025-01-10 00:30:36	Epa	6	4	1	1
31	2025-01-10 00:30:36	Epa	6	4	1	1
32	2025-01-10 00:36:41	A ver	4	3	1	1
33	2025-01-10 00:42:57	Oe	3	4	1	1
34	2025-01-10 00:47:13	Oe	4	3	1	1
35	2025-01-10 00:49:07	Yaaa	3	5	1	1
36	2025-01-10 09:12:53	R	5	3	1	1
\.


--
-- Data for Name: auditoriavia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.auditoriavia (au_via_id, au_via_fechah, au_via_desc, au_via_estadoini, au_via_estadofin, sol_via_dan_id, usu_id) FROM stdin;
1	2025-01-09 09:58:14	dALE, TU PUEDES	4	5	1	1
2	2025-01-09 09:59:49	Ya no?	5	3	1	1
3	2025-01-09 09:59:54	Ya no?	3	7	1	1
4	2025-01-09 10:09:06	Melo mi apa	7	3	1	1
5	2025-01-09 10:09:19	Melo mi apa	7	3	1	1
6	2025-01-09 10:10:06	Melo ya	3	4	1	1
7	2025-01-10 00:26:47	Epa mano	4	3	1	1
8	2025-01-10 00:27:03	Probemos	3	5	2	1
9	2025-01-10 00:27:30	Segun	5	3	2	1
10	2025-01-10 00:29:34	Epa	3	4	2	1
11	2025-01-10 00:40:42	Ya	3	4	1	1
12	2025-01-10 00:40:49	Si	4	5	2	1
13	2025-01-10 00:41:31	Oe	5	6	2	1
14	2025-01-10 00:48:47	OKKKK	6	3	2	1
15	2025-01-10 00:48:54	mELOOO	4	3	1	1
\.


--
-- Data for Name: categoria_reductores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categoria_reductores (id_categoria, nombre_categoria) FROM stdin;
1	Reductores estructurales
2	Reductores de señalización
\.


--
-- Data for Name: categoria_seniales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categoria_seniales (categoria_seniales_id, categoria_seniales_desc) FROM stdin;
1	Reglamentaria
2	Informativa
3	Preventiva
\.


--
-- Data for Name: choque_detalle; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.choque_detalle (choq_detal_id, descripcion, id_perteneciente) FROM stdin;
1	Automóvil con Bus	1
2	Automóvil con Buseta	1
3	Automóvil con Camión	1
4	Automóvil con Camioneta	1
5	Automóvil con Microbús	1
6	Automóvil con Tractocamión	1
7	Automóvil con Volqueta	1
8	Automóvil con Motocicleta	1
9	Automóvil con Bicicleta	1
10	Automóvil con Motocarro	1
11	Automóvil con Cuatrimoto	1
12	Bus con Buseta	1
13	Bus con Camión	1
14	Bus con Camioneta	1
15	Bus con Microbús	1
16	Bus con Tractocamión	1
17	Bus con Volqueta	1
18	Bus con Motocicleta	1
19	Bus con Bicicleta	1
20	Bus con Motocarro	1
21	Bus con Cuatrimoto	1
22	Buseta con Camión	1
23	Buseta con Camioneta	1
24	Buseta con Microbús	1
25	Buseta con Tractocamión	1
26	Buseta con Volqueta	1
27	Buseta con Motocicleta	1
28	Buseta con Bicicleta	1
29	Buseta con Motocarro	1
30	Buseta con Cuatrimoto	1
31	Camión con Camioneta	1
32	Camión con Microbús	1
33	Camión con Tractocamión	1
34	Camión con Volqueta	1
35	Camión con Motocicleta	1
36	Camión con Bicicleta	1
37	Camión con Motocarro	1
38	Camión con Cuatrimoto	1
39	Camioneta con Microbús	1
40	Camioneta con Tractocamión	1
41	Camioneta con Volqueta	1
42	Camioneta con Motocicleta	1
43	Camioneta con Bicicleta	1
44	Camioneta con Motocarro	1
45	Camioneta con Cuatrimoto	1
46	Microbús con Tractocamión	1
47	Microbús con Volqueta	1
48	Microbús con Motocicleta	1
49	Microbús con Bicicleta	1
50	Microbús con Motocarro	1
51	Microbús con Cuatrimoto	1
52	Tractocamión con Volqueta	1
53	Tractocamión con Motocicleta	1
54	Tractocamión con Bicicleta	1
55	Tractocamión con Motocarro	1
56	Tractocamión con Cuatrimoto	1
57	Volqueta con Motocicleta	1
58	Volqueta con Bicicleta	1
59	Volqueta con Motocarro	1
60	Volqueta con Cuatrimoto	1
61	Motocicleta con Bicicleta	1
62	Motocicleta con Motocarro	1
63	Motocicleta con Cuatrimoto	1
64	Bicicleta con Motocarro	1
65	Bicicleta con Cuatrimoto	1
66	Motocarro con Cuatrimoto	1
67	Poste	2
68	Señal de Tránsito	2
69	Árbol	2
70	Muro	2
71	Peatón	3
72	Animal	3
73	Exceso de velocidad	4
74	Maniobra brusca	4
75	Pérdida de control	4
76	Sobrecarga	4
77	Mal estado de la vía	4
78	Curva cerrada	4
79	Evasión de obstáculo	4
80	Terreno resbaladizo	4
\.


--
-- Data for Name: danio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.danio (danio_id, tipo_danio_id, solicitud_id) FROM stdin;
1	1	1
2	2	1
3	3	1
4	4	2
5	5	2
6	6	2
7	7	3
8	8	3
9	9	3
\.


--
-- Data for Name: estados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estados (est_id, est_nombre) FROM stdin;
1	Activo
2	Inactivo
3	Pendiente
4	En revision
5	En proceso
6	Rechazada
7	Completada
\.


--
-- Data for Name: imagenes_accidente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.imagenes_accidente (img_id, reg_acc_id, img_ruta) FROM stdin;
1	1	img/Datosdespuésdelaprueba.jpg
\.


--
-- Data for Name: imagenes_vias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.imagenes_vias (img_id, reg_via_id, img_ruta) FROM stdin;
1	1	img/Datosdeentrada_vacios.jpg
2	2	img/Datosdeentrada_vacios.jpg
\.


--
-- Data for Name: orientacion_seniales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orientacion_seniales (orientacion_id, orientacion_desc) FROM stdin;
1	Vertical
2	Horizontal
\.


--
-- Data for Name: pqrs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pqrs (id_pqrs, desc_pqrs, tipo_pqrs, usu_id, fecha_hora) FROM stdin;
\.


--
-- Data for Name: punto_accidente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.punto_accidente (id, id_accidente, geom) FROM stdin;
1	1	0101000020E610000081B74082E21F53C0C71951DA1B7C0B40
\.


--
-- Data for Name: punto_reductordan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.punto_reductordan (id_red_dan, id_reductordan, geom) FROM stdin;
1	1	0101000020E61000007F4591C8511F53C06D18DF2A626B0B40
\.


--
-- Data for Name: punto_reductornew; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.punto_reductornew (id_red_new, id_reductornew, geom) FROM stdin;
1	1	0101000020E6100000C7260CDDFF1E53C0892291A326670B40
2	2	0101000020E61000005E6DC5FEB21F53C0DC02098A1F630B40
\.


--
-- Data for Name: punto_senialdan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.punto_senialdan (id, id_senialdan, geom) FROM stdin;
1	1	0101000020E6100000BAFC87F4DB1F53C0970E7708F6720B40
\.


--
-- Data for Name: punto_senialnew; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.punto_senialnew (id, id_senialnew, geom) FROM stdin;
1	1	0101000020E61000008713AB192C1F53C0869112A8EB760B40
\.


--
-- Data for Name: punto_via; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.punto_via (id, id_via, geom) FROM stdin;
1	1	0101000020E6100000736891ED7C1F53C0E6B4814E1B680B40
2	2	0101000020E6100000D734EF38451F53C0E5C039234A7B0B40
\.


--
-- Data for Name: reg_acc_vehi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reg_acc_vehi (reg_acc_vehi_id, reg_acc_id, vehiculo_id) FROM stdin;
1	1	1
2	1	3
\.


--
-- Data for Name: registro_accidente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.registro_accidente (reg_acc_id, reg_acc_fecha_hora, tipo_accidente_id, reg_acc_lesionados, reg_acc_observaciones, usu_id) FROM stdin;
1	2025-01-08 23:14:34	1	t	Hola si ya me funciono, soy demasiado buenooo	1
\.


--
-- Data for Name: registro_detalle_accidente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.registro_detalle_accidente (reg_det_acc_id, reg_acc_id, choque_detalle_id) FROM stdin;
1	1	2
\.


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rol (rol_id, rol_nombre) FROM stdin;
1	Admin
2	Ciudadano
3	Funcionario
\.


--
-- Data for Name: sexo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sexo (sex_id, sex_desc) FROM stdin;
1	Masculino
2	Femenino
\.


--
-- Data for Name: solicitud_reductores_dan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitud_reductores_dan (sol_red_dan_id, tipo_red_id, danio_id, desc_red, sol_red_dan_fecha, img_red_dan, est_sol_id, usu_id) FROM stdin;
1	3	7	Dale vamos reductorcito dale broderrrr	2025-01-08 23:18:39	Datosdeentrada.jpg	3	1
\.


--
-- Data for Name: solicitud_reductores_new; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitud_reductores_new (sol_red_new_id, tipo_red_id, desc_red_new, sol_red_new_fecha, img_red_new, est_sol_id, usu_id) FROM stdin;
1	4	Dale tu reductor numero dos es tu momento mi apa	2025-01-08 23:19:55	Mapaconceptual.png	4	1
2	4	Probemos ahora si menor ehh cuanto puesss	2025-01-09 16:04:23	Datosdeentrada_vacios.jpg	4	2
\.


--
-- Data for Name: solicitud_seniales_dan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitud_seniales_dan (sol_sen_dan_id, tipo_sen_id, desc_sen_dan, danio_id, sol_sen_dan_fecha, img_sen_dan, est_sol_id, usu_id) FROM stdin;
1	5	A ver tu que tienes demuestra dale dale	4	2025-01-08 23:17:43	img_preventivas.jpg	5	1
\.


--
-- Data for Name: solicitud_seniales_new; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitud_seniales_new (sol_sen_new_id, tipo_sen_id, desc_sen, sol_sen_new_fecha, est_sol_id, usu_id) FROM stdin;
1	1	Vamos, ahora tu, tu momento de brillar, lucete	2025-01-08 23:16:34	3	1
\.


--
-- Data for Name: solicitud_via_dan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitud_via_dan (sol_via_dan_id, tipo_dano_via_id, descripcion_via, fecha_hora, est_sol_id, usu_id, via_id) FROM stdin;
2	1	Melo ya todo sirve, solo unas validaciones y ya 	2025-01-09 15:54:00	3	1	3
1	1	Dale ahora tu, la ultima pero no menos importante	2025-01-08 23:20:35	3	1	2
\.


--
-- Data for Name: spatial_ref_sys; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
\.


--
-- Data for Name: tipo_choque; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_choque (tipo_choque_id, tipo_choque_desc) FROM stdin;
1	Colisión entre vehiculos
2	Colisión con objeto fijo
3	Atropello
4	Volcamiento
\.


--
-- Data for Name: tipo_danio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_danio (tipo_danio_id, tipo_danio_desc) FROM stdin;
1	Huecos en la vía
2	Fisuras o grietas
3	Hundimientos
4	Señal caída
5	Señal vandalizada
6	Señal ilegible
7	Desgaste en reductores
8	Desnivel en reductores
9	Ausencia de reductores
\.


--
-- Data for Name: tipo_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_documento (doc_id, nombre_tipo, doc_abrev) FROM stdin;
1	Cedula de ciudadania	CC
2	Cedula de extranjeria	CE
\.


--
-- Data for Name: tipo_estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_estado (id_tipo_estado, id_estado, id_perteneciente) FROM stdin;
1	1	1
2	2	1
3	3	2
4	4	2
5	5	2
6	6	2
7	7	2
\.


--
-- Data for Name: tipo_pqrs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_pqrs (id_tipo_pqrs, desc_tipo_pqrs) FROM stdin;
1	Peticion
2	Queja
3	Reclamos
4	Sugerencias
\.


--
-- Data for Name: tipo_seniales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_seniales (tipo_senial_id, tipo_sen_desc, desc_sen, img_sen, orientacion_id, cat_id) FROM stdin;
1	Alto o pare	Son las que más se suelen encontrar a lo largo de las carreteras, indican al conductor que debe detener el vehículo	imgSen/pare.jpg	1	1
2	Ceda el paso	Señal de tránsito que indica al conductor que debe ceder el paso a los vehículos que circulan por la vía a la que se aproxima	imgSen/ceda_el_paso.jpg	1	1
3	Siga de frente	Esta señal se empleará para advertir a los usuarios de las vías, la proximidad a un sitio en el cual se desvía la circulación del tránsito	imgSen/siga_de_frente.jpg	1	1
4	No pase	Indica al conductor que está prohibido avanzar en esa dirección	imgSen/no_pase.jpg	1	1
5	Giro a la izquierda	Anuncian la proximidad de un giro peligroso a la izquierda	imgSen/giro_izquierda.jpg	1	1
6	Prohibido girar a la izquierda	Indica que no se permite realizar giros a la izquierda	imgSen/prohibido_girar_izquierda.jpg	1	1
7	Giro a la derecha	Anuncian la proximidad de un giro peligroso a la derecha	imgSen/giro_derecha.jpg	1	1
8	Prohibido girar a la derecha	Indica que no se permite realizar giros a la derecha	imgSen/prohibido_girar_derecha.jpg	1	1
9	Prohibido girar en "U"	Señal que indica que no se puede realizar un giro en forma de "U"	imgSen/prohibido_girar_u.jpg	1	1
10	Doble vía	Indica que la vía cuenta con doble sentido de circulación	imgSen/doble_via.jpg	1	1
11	Tres carriles (uno en contraflujo)	Indica que hay tres carriles disponibles, uno de los cuales está en sentido contrario	imgSen/tres_carriles_uno_contraflujo.jpg	1	1
12	Tres carriles (dos en contraflujo)	Indica que hay tres carriles disponibles, dos de los cuales están en sentido contrario	imgSen/tres_carriles_dos_contraflujo.jpg	1	1
13	Prohibido el cambio de calzada	Prohíbe a los conductores cruzar de un carril a otro en la vía	imgSen/prohibido_cambio_calzada.jpg	1	1
14	Circulación prohibida de vehículos automotores	Indica que no está permitido el paso de vehículos automotores	imgSen/circulacion_prohibida_automotores.jpg	1	1
15	Vehículos pesados a la derecha	Señala que los vehículos pesados deben circular por el lado derecho de la vía	imgSen/vehiculos_pesados_derecha.jpg	1	1
16	Circulación prohibida de vehículos de carga	Prohíbe el tránsito de vehículos destinados al transporte de carga	imgSen/circulacion_prohibida_carga.jpg	1	1
17	Peatones a la izquierda	Indica que los peatones deben circular por el lado izquierdo de la vía	imgSen/peatones_izquierda.jpg	1	1
18	Curva sucesiva (primero derecha)	Advierte sobre una curva doble, siendo la primera hacia la derecha	imgSen/curva_sucesiva_derecha.jpg	1	1
19	Prohibido parquear	Prohíbe estacionar en la zona señalada	imgSen/prohibido_parquear.jpg	1	1
20	Prohibido pitar	Prohíbe el uso de bocinas en la zona señalada	imgSen/prohibido_pitar.jpg	1	1
21	Velocidad máxima	Indica el límite máximo de velocidad permitido en esa vía	imgSen/velocidad_maxima.jpg	1	1
22	Peso máximo total permitido	Indica el peso máximo permitido para vehículos en esa vía	imgSen/peso_maximo_total.jpg	1	1
23	Altura máxima permitida	Señal que indica la altura máxima permitida para vehículos en esa vía	imgSen/altura_maxima.jpg	2	1
24	Ancho máximo permitido	Indica el ancho máximo permitido para vehículos que transitan por esa vía	imgSen/ancho_maximo.jpg	1	1
25	Zona de estacionamiento de taxis	Indica un área designada exclusivamente para el estacionamiento de taxis	imgSen/zona_taxis.jpg	1	1
26	Circulación de carga baja	Permite únicamente la circulación de vehículos con carga baja	imgSen/circulacion_carga_baja.jpg	1	1
27	Retén	Señal que indica la proximidad de un retén policial o de control	imgSen/reten.jpg	1	1
28	Ciclorruta	Indica un carril o vía exclusiva para bicicletas	imgSen/ciclorruta.jpg	1	1
29	Sentido único de circulación	Indica que la vía tiene un solo sentido de circulación	imgSen/sentido_unico.jpg	1	1
30	Sentido de circulación doble	Indica que la vía tiene doble sentido de circulación	imgSen/sentido_doble.jpg	1	1
31	Paradero	Indica la ubicación de un punto de parada autorizado para transporte público	imgSen/paradero.jpg	1	1
32	Prohibido dejar o recoger pasajeros	Prohíbe detenerse para subir o bajar pasajeros en esa zona	imgSen/prohibido_recoger_pasajeros.jpg	1	1
33	Zona de cargue y descargue	Señala un área destinada al cargue y descargue de mercancías	imgSen/zona_cargue_descargue.jpg	1	1
34	Prohibido el cargue y descargue	Indica que no está permitido realizar actividades de cargue y descargue en esa zona	imgSen/prohibido_cargue_descargue.jpg	1	1
35	Espaciamiento	Indica la distancia mínima que los vehículos deben mantener entre sí	imgSen/espaciamiento.jpg	1	1
36	Indicación de semáforo para giro a la izquierda	Señala que existe un semáforo específico para giros a la izquierda	imgSen/semaforo_giro_izquierda.jpg	1	1
37	Indicación de semáforo para giro a la derecha	Señala que existe un semáforo específico para giros a la derecha	imgSen/semaforo_giro_derecha.jpg	1	1
38	Vía cerrada	Indica que la vía está cerrada al tránsito	imgSen/via_cerrada.jpg	1	1
39	Desvío	Señala una ruta alterna debido a una interrupción en la vía principal	imgSen/desvio.jpg	2	1
40	Paso uno a uno	Indica que los vehículos deben alternar el paso en la zona señalada	imgSen/paso_uno_a_uno.jpg	1	1
41	Ruta Nacional	Indica una ruta nacional importante.	imgSen/ruta_nacional.jpg	1	2
42	Ruta Departamental	Señala una ruta dentro de un departamento.	imgSen/ruta_departamental.jpg	1	2
43	Ruta Panamericana	Indica que la vía es parte de la Ruta Panamericana.	imgSen/ruta_panamericana.jpg	1	2
44	Ruta Marginal de la Selva	Señala que la vía pertenece a la Ruta Marginal de la Selva.	imgSen/ruta_marginal_selva.jpg	1	2
45	Poste de referencia	Indica un poste con información referencial.	imgSen/poste_referencia.jpg	1	2
46	Información previa de destino	Señala información útil antes de llegar a un destino.	imgSen/informacion_previa_destino.jpg	2	2
47	Información de destino	Indica información específica de un destino.	imgSen/informacion_destino.jpg	2	2
48	Croquis	Representa un croquis o mapa del área.	imgSen/croquis.jpg	2	2
49	Descripción de giros	Indica cómo realizar giros en intersecciones.	imgSen/descripcion_giros.jpg	2	2
50	Confirmación de nomenclatura de carretera	Señala la nomenclatura oficial de una vía.	imgSen/nomenclatura_carretera.jpg	2	2
51	Sitio de parqueo	Indica un lugar designado para estacionar vehículos.	imgSen/sitio_parqueo.jpg	1	1
52	Zona especiales de parqueo	Señala áreas exclusivas para estacionamiento especial.	imgSen/zona_especial_parqueo.jpg	1	2
53	Paradero de buses	Indica un punto oficial de parada para buses.	imgSen/paradero_buses.jpg	1	2
54	Transbordador	Indica la presencia de un transbordador.	imgSen/transbordador.jpg	1	1
55	Monumento nacional	Indica la proximidad a un monumento de importancia nacional.	imgSen/monumento_nacional.jpg	1	2
56	Zona militar	Señala la proximidad a una zona militar.	imgSen/zona_militar.jpg	1	2
57	Aeropuerto	Indica la proximidad a un aeropuerto.	imgSen/aeropuerto.jpg	1	2
58	Hospedaje	Señala lugares destinados al hospedaje.	imgSen/hospedaje.jpg	1	2
59	Primeros auxilios	Indica la presencia de servicios de primeros auxilios.	imgSen/primeros_auxilios.jpg	1	2
60	Servicios sanitarios	Señala la ubicación de servicios sanitarios.	imgSen/servicios_sanitarios.jpg	1	2
61	Restaurante	Indica la proximidad a un restaurante.	imgSen/restaurante.jpg	1	2
62	Teléfono	Señala la ubicación de un teléfono público o servicio telefónico.	imgSen/telefono.jpg	1	2
63	Iglesia	Indica la proximidad a una iglesia o lugar de culto.	imgSen/iglesia.jpg	1	2
64	Taller	Señala la ubicación de un taller mecánico.	imgSen/taller.jpg	1	2
65	Estación de servicio	Indica la proximidad a una gasolinera o estación de servicio.	imgSen/estacion_servicio.jpg	1	2
66	Montallantas	Señala un lugar donde se realizan servicios de cambio o reparación de llantas.	imgSen/montallantas.jpg	1	2
67	Cruce peatonal	Indica un lugar designado para que los peatones crucen la vía.	imgSen/cruce_peatonal.jpg	1	2
68	Discapacitados	Señala un área o servicio destinado a personas con discapacidad.	imgSen/discapacitados.jpg	1	2
69	Nomenclatura urbana	Indica información sobre la nomenclatura de calles o avenidas.	imgSen/nomenclatura_urbana.jpg	2	2
70	Transporte ferroviario	Señala un área relacionada con transporte en tren.	imgSen/transporte_ferroviario.jpg	2	2
71	Transporte masivo	Indica la presencia de sistemas de transporte público masivo.	imgSen/transporte_masivo.jpg	1	2
72	Zona recreativa	Señala la proximidad a un área de recreación.	imgSen/zona_recreativa.jpg	1	2
73	Obra en la vía	Indica que se realizan trabajos en la vía.	imgSen/obra_en_via.jpg	1	2
74	Inicio de obra	Señala el inicio de una obra en la vía.	imgSen/inicio_obra.jpg	1	2
75	Fin de obra	Indica el fin de los trabajos en la vía.	imgSen/fin_obra.jpg	1	2
76	Carril izquierdo cerrado	Señala que el carril izquierdo está cerrado.	imgSen/carril_izquierdo_cerrado.jpg	1	2
77	Resalto	Señala la presencia de un resalto en la vía.	imgSen/resalto.jpg	2	3
78	Depresión	Indica la presencia de una depresión en la vía.	imgSen/depresion.jpg	2	3
79	Descenso peligroso	Advierte de un descenso peligroso.	imgSen/descenso_peligroso.jpg	2	3
80	Reducción simétrica de calzada	Señala la reducción simétrica de la calzada.	imgSen/reduccion_simetrica.png	2	3
81	Reducción asimétrica de calzada derecha	Indica la reducción de la calzada por el lado derecho.	imgSen/reduccion_asim_der.jpg	2	3
82	Reducción asimétrica de calzada izquierda	Indica la reducción de la calzada por el lado izquierdo.	imgSen/reduccion_asim_izq.jpg	2	3
83	Puente angosto	Advierte sobre un puente angosto en la vía.	imgSen/puente_angosto.jpg	2	3
84	Túnel	Señala la presencia de un túnel en la vía.	imgSen/tunel.jpg	1	3
85	Zona de derrumbe	Advierte sobre una zona con posible derrumbe.	imgSen/zona_derrumbe.png	2	3
86	Superficie deslizante	Advierte sobre una superficie deslizante en la vía.	imgSen/superficie_deslizante.jpg	2	3
87	Maquinaria agrícola en la vía	Señala la posible presencia de maquinaria agrícola en la vía.	imgSen/maquinaria_agricola.jpg	2	3
88	Peatones en la vía	Advierte sobre la presencia de peatones en la vía.	imgSen/peatones_via.jpg	2	3
89	Zona escolar	Señala la proximidad de una zona escolar.	imgSen/zona_escolar.jpg	1	3
90	Riesgo de accidente	Señala un punto con alto riesgo de accidente.	imgSen/riesgo_accidente.jpg	2	3
\.


--
-- Data for Name: tipo_via; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_via (id_tipo_via, desc_via) FROM stdin;
1	Calle
2	Carrera
3	Avenida
4	Transversal
5	Diagonal
6	Autopista
7	Vía de circunvalación
\.


--
-- Data for Name: tipos_reductores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipos_reductores (tipo_red_id, nombre_tipo_red, descripcion_tipo_red, img_reductor, cat_id) FROM stdin;
1	Reductor de concreto	Entre todos los tipos de reductores de velocidad vial, todavía son los más comunes de ver. Como su nombre lo indica, son aquellos topes hechos en concreto.	img/reductorpavimento.jpg	1
2	Reductor de resalto virtual	Aunque tienen menos presencia, podría decirse que también son reductores de concreto, pero no propiamente como los topes. Esto se debe a que no cuentan con volumen, pero sí están sobre el pavimento.	img/reductorvirtual.jpg	2
3	Tachas reflectivas	Son pequeños dispositivos que, más que reductores, sirven para acompañar las señaléticas en el pavimento. Pueden ser fabricadas tanto en plástico como en acero	img/tachasRef.jpg	2
4	Reductor plastico	Son dispositivos diseñados para disminuir la velocidad de los vehículos en zonas específicas, como cruces peatonales, escuelas, hospitales, zonas residenciales, estacionamientos y áreas de alta circulación de personas.	img/reductorplastico.jpg	1
\.


--
-- Data for Name: tokens_contra; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tokens_contra (id_token, token, usu_id, expiracion) FROM stdin;
1	JGOSO	2	2025-01-09 22:30:16.445
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (usu_id, usu_documento, usu_nombre1, usu_nombre2, usu_apellido1, usu_apellido2, usu_correo, usu_clave, usu_tel, usu_direccion, rol_id, est_id, doc_id, sex_id) FROM stdin;
1	1106514243	Jose	Daniel	Ruiz	Montaño	jose@gmail.com	3c165908b463ee85a6a32ab2f7c25a9f8a31431cd2cca0a128ea1db41fca8657	3013623149	Calle 120 C 22 42	1	1	1	1
2	12345678	Prueba	Prueba	Prueba	\N	josedaniruizm2005@gmail.com	e57075eb0159e5563f34a034eca9a4ca26354449c2fce27c9f8ca290d73b3424	3113457699	Calle 123 J 22  42 Ref. Desepaz	2	1	1	1
\.


--
-- Data for Name: vehiculo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vehiculo (vehiculo_id, vehiculo_descripcion) FROM stdin;
1	Automóvil
2	Bus
3	Buseta
4	Camión
5	Camioneta
6	Microbús
7	Tractocamión
8	Volqueta
9	Motocicleta
10	Bicicleta
11	Motocarro
12	Cuatrimoto
\.


--
-- Data for Name: topology; Type: TABLE DATA; Schema: topology; Owner: postgres
--

COPY topology.topology (id, name, srid, "precision", hasz) FROM stdin;
\.


--
-- Data for Name: layer; Type: TABLE DATA; Schema: topology; Owner: postgres
--

COPY topology.layer (topology_id, layer_id, schema_name, table_name, feature_column, feature_type, level, child_id) FROM stdin;
\.


--
-- Name: auditoria_usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoria_usuarios_id_seq', 1, true);


--
-- Name: auditoriaaccidente_au_acc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoriaaccidente_au_acc_id_seq', 1, false);


--
-- Name: auditoriareddan_au_red_dan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoriareddan_au_red_dan_id_seq', 1, false);


--
-- Name: auditoriarednew_au_red_new_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoriarednew_au_red_new_id_seq', 1, false);


--
-- Name: auditoriasendan_au_sen_dan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoriasendan_au_sen_dan_id_seq', 1, false);


--
-- Name: auditoriasennew_au_sen_new_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoriasennew_au_sen_new_id_seq', 1, false);


--
-- Name: auditoriavia_au_via_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.auditoriavia_au_via_id_seq', 1, false);


--
-- Name: categoria_reductores_id_categoria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categoria_reductores_id_categoria_seq', 2, true);


--
-- Name: categoria_seniales_categoria_seniales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categoria_seniales_categoria_seniales_id_seq', 1, false);


--
-- Name: estados_est_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.estados_est_id_seq', 1, false);


--
-- Name: orientacion_seniales_orientacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orientacion_seniales_orientacion_id_seq', 1, false);


--
-- Name: pqrs_id_pqrs_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pqrs_id_pqrs_seq', 1, false);


--
-- Name: punto_accidente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.punto_accidente_id_seq', 1, true);


--
-- Name: punto_reductordan_id_red_dan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.punto_reductordan_id_red_dan_seq', 1, true);


--
-- Name: punto_reductornew_id_red_new_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.punto_reductornew_id_red_new_seq', 2, true);


--
-- Name: punto_senialdan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.punto_senialdan_id_seq', 1, true);


--
-- Name: punto_senialnew_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.punto_senialnew_id_seq', 1, true);


--
-- Name: punto_via_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.punto_via_id_seq', 2, true);


--
-- Name: registro_accidente_reg_acc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.registro_accidente_reg_acc_id_seq', 1, false);


--
-- Name: rol_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rol_rol_id_seq', 1, false);


--
-- Name: sexo_sex_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sexo_sex_id_seq', 1, false);


--
-- Name: solicitud_reductores_dan_sol_red_dan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitud_reductores_dan_sol_red_dan_id_seq', 1, false);


--
-- Name: solicitud_reductores_new_sol_red_new_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitud_reductores_new_sol_red_new_id_seq', 1, false);


--
-- Name: solicitud_seniales_dan_sol_sen_dan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitud_seniales_dan_sol_sen_dan_id_seq', 1, false);


--
-- Name: solicitud_seniales_new_sol_sen_new_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitud_seniales_new_sol_sen_new_id_seq', 1, false);


--
-- Name: tipo_danio_tipo_danio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_danio_tipo_danio_id_seq', 1, false);


--
-- Name: tipo_documento_doc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_documento_doc_id_seq', 1, false);


--
-- Name: tipo_estado_id_tipo_estado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_estado_id_tipo_estado_seq', 1, false);


--
-- Name: tipo_pqrs_id_tipo_pqrs_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_pqrs_id_tipo_pqrs_seq', 1, false);


--
-- Name: tipo_seniales_tipo_senial_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_seniales_tipo_senial_id_seq', 1, false);


--
-- Name: tipo_via_id_tipo_via_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_via_id_tipo_via_seq', 7, true);


--
-- Name: tipos_reductores_tipo_red_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipos_reductores_tipo_red_id_seq', 1, false);


--
-- Name: tokens_contra_id_token_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tokens_contra_id_token_seq', 1, false);


--
-- Name: usuarios_usu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_usu_id_seq', 1, false);


--
-- Name: auditoria_usuarios auditoria_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoria_usuarios
    ADD CONSTRAINT auditoria_usuarios_pkey PRIMARY KEY (id);


--
-- Name: auditoriaaccidente auditoriaaccidente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriaaccidente
    ADD CONSTRAINT auditoriaaccidente_pkey PRIMARY KEY (au_acc_id);


--
-- Name: auditoriareddan auditoriareddan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriareddan
    ADD CONSTRAINT auditoriareddan_pkey PRIMARY KEY (au_red_dan_id);


--
-- Name: auditoriarednew auditoriarednew_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriarednew
    ADD CONSTRAINT auditoriarednew_pkey PRIMARY KEY (au_red_new_id);


--
-- Name: auditoriasendan auditoriasendan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriasendan
    ADD CONSTRAINT auditoriasendan_pkey PRIMARY KEY (au_sen_dan_id);


--
-- Name: auditoriasennew auditoriasennew_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriasennew
    ADD CONSTRAINT auditoriasennew_pkey PRIMARY KEY (au_sen_new_id);


--
-- Name: auditoriavia auditoriavia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auditoriavia
    ADD CONSTRAINT auditoriavia_pkey PRIMARY KEY (au_via_id);


--
-- Name: categoria_reductores categoria_reductores_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categoria_reductores
    ADD CONSTRAINT categoria_reductores_pkey PRIMARY KEY (id_categoria);


--
-- Name: categoria_seniales categoria_seniales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categoria_seniales
    ADD CONSTRAINT categoria_seniales_pkey PRIMARY KEY (categoria_seniales_id);


--
-- Name: choque_detalle choque_detalle_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.choque_detalle
    ADD CONSTRAINT choque_detalle_pkey PRIMARY KEY (choq_detal_id);


--
-- Name: danio danio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.danio
    ADD CONSTRAINT danio_pkey PRIMARY KEY (danio_id);


--
-- Name: estados estados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (est_id);


--
-- Name: imagenes_accidente imagenes_accidente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.imagenes_accidente
    ADD CONSTRAINT imagenes_accidente_pkey PRIMARY KEY (img_id);


--
-- Name: imagenes_vias imagenes_vias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.imagenes_vias
    ADD CONSTRAINT imagenes_vias_pkey PRIMARY KEY (img_id);


--
-- Name: orientacion_seniales orientacion_seniales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orientacion_seniales
    ADD CONSTRAINT orientacion_seniales_pkey PRIMARY KEY (orientacion_id);


--
-- Name: pqrs pqrs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pqrs
    ADD CONSTRAINT pqrs_pkey PRIMARY KEY (id_pqrs);


--
-- Name: reg_acc_vehi reg_acc_vehi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reg_acc_vehi
    ADD CONSTRAINT reg_acc_vehi_pkey PRIMARY KEY (reg_acc_vehi_id);


--
-- Name: registro_accidente registro_accidente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registro_accidente
    ADD CONSTRAINT registro_accidente_pkey PRIMARY KEY (reg_acc_id);


--
-- Name: registro_detalle_accidente registro_detalle_accidente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registro_detalle_accidente
    ADD CONSTRAINT registro_detalle_accidente_pkey PRIMARY KEY (reg_det_acc_id);


--
-- Name: rol rol_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (rol_id);


--
-- Name: sexo sexo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sexo
    ADD CONSTRAINT sexo_pkey PRIMARY KEY (sex_id);


--
-- Name: solicitud_reductores_dan solicitud_reductores_dan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_dan
    ADD CONSTRAINT solicitud_reductores_dan_pkey PRIMARY KEY (sol_red_dan_id);


--
-- Name: solicitud_reductores_new solicitud_reductores_new_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_new
    ADD CONSTRAINT solicitud_reductores_new_pkey PRIMARY KEY (sol_red_new_id);


--
-- Name: solicitud_seniales_dan solicitud_seniales_dan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_dan
    ADD CONSTRAINT solicitud_seniales_dan_pkey PRIMARY KEY (sol_sen_dan_id);


--
-- Name: solicitud_seniales_new solicitud_seniales_new_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_new
    ADD CONSTRAINT solicitud_seniales_new_pkey PRIMARY KEY (sol_sen_new_id);


--
-- Name: solicitud_via_dan solicitud_via_dan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_via_dan
    ADD CONSTRAINT solicitud_via_dan_pkey PRIMARY KEY (sol_via_dan_id);


--
-- Name: tipo_choque tipo_choque_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_choque
    ADD CONSTRAINT tipo_choque_pkey PRIMARY KEY (tipo_choque_id);


--
-- Name: tipo_danio tipo_danio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_danio
    ADD CONSTRAINT tipo_danio_pkey PRIMARY KEY (tipo_danio_id);


--
-- Name: tipo_documento tipo_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_documento
    ADD CONSTRAINT tipo_documento_pkey PRIMARY KEY (doc_id);


--
-- Name: tipo_estado tipo_estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_estado
    ADD CONSTRAINT tipo_estado_pkey PRIMARY KEY (id_tipo_estado);


--
-- Name: tipo_pqrs tipo_pqrs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_pqrs
    ADD CONSTRAINT tipo_pqrs_pkey PRIMARY KEY (id_tipo_pqrs);


--
-- Name: tipo_seniales tipo_seniales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_seniales
    ADD CONSTRAINT tipo_seniales_pkey PRIMARY KEY (tipo_senial_id);


--
-- Name: tipo_via tipo_via_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_via
    ADD CONSTRAINT tipo_via_pkey PRIMARY KEY (id_tipo_via);


--
-- Name: tipos_reductores tipos_reductores_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_reductores
    ADD CONSTRAINT tipos_reductores_pkey PRIMARY KEY (tipo_red_id);


--
-- Name: tokens_contra tokens_contra_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tokens_contra
    ADD CONSTRAINT tokens_contra_pkey PRIMARY KEY (id_token);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (usu_id);


--
-- Name: vehiculo vehiculo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vehiculo
    ADD CONSTRAINT vehiculo_pkey PRIMARY KEY (vehiculo_id);


--
-- Name: usuarios trigger_registrar_usuario; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_registrar_usuario AFTER INSERT ON public.usuarios FOR EACH ROW EXECUTE PROCEDURE public.registrar_usuario();


--
-- Name: choque_detalle choque_detalle_id_perteneciente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.choque_detalle
    ADD CONSTRAINT choque_detalle_id_perteneciente_fkey FOREIGN KEY (id_perteneciente) REFERENCES public.tipo_choque(tipo_choque_id);


--
-- Name: tipos_reductores fk_cat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_reductores
    ADD CONSTRAINT fk_cat FOREIGN KEY (cat_id) REFERENCES public.categoria_reductores(id_categoria);


--
-- Name: solicitud_seniales_dan fk_dan; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_dan
    ADD CONSTRAINT fk_dan FOREIGN KEY (danio_id) REFERENCES public.danio(danio_id);


--
-- Name: solicitud_seniales_new fk_est_sol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_new
    ADD CONSTRAINT fk_est_sol FOREIGN KEY (est_sol_id) REFERENCES public.estados(est_id);


--
-- Name: solicitud_seniales_dan fk_est_sol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_dan
    ADD CONSTRAINT fk_est_sol FOREIGN KEY (est_sol_id) REFERENCES public.estados(est_id);


--
-- Name: solicitud_seniales_new fk_tipo_sen; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_new
    ADD CONSTRAINT fk_tipo_sen FOREIGN KEY (tipo_sen_id) REFERENCES public.tipo_seniales(tipo_senial_id);


--
-- Name: solicitud_seniales_dan fk_tipo_sen; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_dan
    ADD CONSTRAINT fk_tipo_sen FOREIGN KEY (tipo_sen_id) REFERENCES public.tipo_seniales(tipo_senial_id);


--
-- Name: solicitud_seniales_new fk_usu; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_new
    ADD CONSTRAINT fk_usu FOREIGN KEY (usu_id) REFERENCES public.usuarios(usu_id);


--
-- Name: solicitud_seniales_dan fk_usu; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_seniales_dan
    ADD CONSTRAINT fk_usu FOREIGN KEY (usu_id) REFERENCES public.usuarios(usu_id);


--
-- Name: imagenes_accidente imagenes_accidente_reg_acc_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.imagenes_accidente
    ADD CONSTRAINT imagenes_accidente_reg_acc_id_fkey FOREIGN KEY (reg_acc_id) REFERENCES public.registro_accidente(reg_acc_id);


--
-- Name: imagenes_vias imagenes_vias_reg_via_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.imagenes_vias
    ADD CONSTRAINT imagenes_vias_reg_via_id_fkey FOREIGN KEY (reg_via_id) REFERENCES public.solicitud_via_dan(sol_via_dan_id);


--
-- Name: pqrs pqrs_tipo_pqrs_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pqrs
    ADD CONSTRAINT pqrs_tipo_pqrs_fkey FOREIGN KEY (tipo_pqrs) REFERENCES public.tipo_pqrs(id_tipo_pqrs);


--
-- Name: pqrs pqrs_usu_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pqrs
    ADD CONSTRAINT pqrs_usu_id_fkey FOREIGN KEY (usu_id) REFERENCES public.usuarios(usu_id);


--
-- Name: punto_via punto_via_id_via_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.punto_via
    ADD CONSTRAINT punto_via_id_via_fkey FOREIGN KEY (id_via) REFERENCES public.solicitud_via_dan(sol_via_dan_id);


--
-- Name: reg_acc_vehi reg_acc_vehi_reg_acc_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reg_acc_vehi
    ADD CONSTRAINT reg_acc_vehi_reg_acc_id_fkey FOREIGN KEY (reg_acc_id) REFERENCES public.registro_accidente(reg_acc_id);


--
-- Name: reg_acc_vehi reg_acc_vehi_vehiculo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reg_acc_vehi
    ADD CONSTRAINT reg_acc_vehi_vehiculo_id_fkey FOREIGN KEY (vehiculo_id) REFERENCES public.vehiculo(vehiculo_id);


--
-- Name: registro_accidente registro_accidente_usu_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registro_accidente
    ADD CONSTRAINT registro_accidente_usu_id_fkey FOREIGN KEY (usu_id) REFERENCES public.usuarios(usu_id);


--
-- Name: registro_detalle_accidente registro_detalle_accidente_choque_detalle_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registro_detalle_accidente
    ADD CONSTRAINT registro_detalle_accidente_choque_detalle_id_fkey FOREIGN KEY (choque_detalle_id) REFERENCES public.choque_detalle(choq_detal_id);


--
-- Name: registro_detalle_accidente registro_detalle_accidente_reg_acc_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registro_detalle_accidente
    ADD CONSTRAINT registro_detalle_accidente_reg_acc_id_fkey FOREIGN KEY (reg_acc_id) REFERENCES public.registro_accidente(reg_acc_id);


--
-- Name: solicitud_reductores_dan solicitud_reductores_dan_danio_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_dan
    ADD CONSTRAINT solicitud_reductores_dan_danio_id_fkey FOREIGN KEY (danio_id) REFERENCES public.tipo_danio(tipo_danio_id);


--
-- Name: solicitud_reductores_dan solicitud_reductores_dan_est_sol_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_dan
    ADD CONSTRAINT solicitud_reductores_dan_est_sol_id_fkey FOREIGN KEY (est_sol_id) REFERENCES public.estados(est_id);


--
-- Name: solicitud_reductores_dan solicitud_reductores_dan_tipo_red_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_dan
    ADD CONSTRAINT solicitud_reductores_dan_tipo_red_id_fkey FOREIGN KEY (tipo_red_id) REFERENCES public.tipos_reductores(tipo_red_id);


--
-- Name: solicitud_reductores_dan solicitud_reductores_dan_usu_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_dan
    ADD CONSTRAINT solicitud_reductores_dan_usu_id_fkey FOREIGN KEY (usu_id) REFERENCES public.usuarios(usu_id);


--
-- Name: solicitud_reductores_new solicitud_reductores_new_est_sol_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_new
    ADD CONSTRAINT solicitud_reductores_new_est_sol_id_fkey FOREIGN KEY (est_sol_id) REFERENCES public.estados(est_id);


--
-- Name: solicitud_reductores_new solicitud_reductores_new_tipo_red_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_new
    ADD CONSTRAINT solicitud_reductores_new_tipo_red_id_fkey FOREIGN KEY (tipo_red_id) REFERENCES public.tipos_reductores(tipo_red_id);


--
-- Name: solicitud_reductores_new solicitud_reductores_new_usu_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_reductores_new
    ADD CONSTRAINT solicitud_reductores_new_usu_id_fkey FOREIGN KEY (usu_id) REFERENCES public.usuarios(usu_id);


--
-- Name: solicitud_via_dan solicitud_via_dan_est_sol_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_via_dan
    ADD CONSTRAINT solicitud_via_dan_est_sol_id_fkey FOREIGN KEY (est_sol_id) REFERENCES public.estados(est_id);


--
-- Name: solicitud_via_dan solicitud_via_dan_tipo_dano_via_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_via_dan
    ADD CONSTRAINT solicitud_via_dan_tipo_dano_via_id_fkey FOREIGN KEY (tipo_dano_via_id) REFERENCES public.danio(danio_id);


--
-- Name: solicitud_via_dan solicitud_via_dan_usu_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_via_dan
    ADD CONSTRAINT solicitud_via_dan_usu_id_fkey FOREIGN KEY (usu_id) REFERENCES public.usuarios(usu_id);


--
-- Name: solicitud_via_dan solicitud_via_dan_via_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_via_dan
    ADD CONSTRAINT solicitud_via_dan_via_id_fkey FOREIGN KEY (via_id) REFERENCES public.tipo_via(id_tipo_via);


--
-- Name: tipo_estado tipo_estado_id_estado_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_estado
    ADD CONSTRAINT tipo_estado_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES public.estados(est_id);


--
-- Name: tipo_seniales tipo_seniales_cat_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_seniales
    ADD CONSTRAINT tipo_seniales_cat_id_fkey FOREIGN KEY (cat_id) REFERENCES public.categoria_seniales(categoria_seniales_id);


--
-- Name: tipo_seniales tipo_seniales_orientacion_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_seniales
    ADD CONSTRAINT tipo_seniales_orientacion_id_fkey FOREIGN KEY (orientacion_id) REFERENCES public.orientacion_seniales(orientacion_id);


--
-- Name: tokens_contra tokens_contra_usu_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tokens_contra
    ADD CONSTRAINT tokens_contra_usu_id_fkey FOREIGN KEY (usu_id) REFERENCES public.usuarios(usu_id);


--
-- Name: usuarios usuarios_doc_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_doc_id_fkey FOREIGN KEY (doc_id) REFERENCES public.tipo_documento(doc_id);


--
-- Name: usuarios usuarios_est_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_est_id_fkey FOREIGN KEY (est_id) REFERENCES public.estados(est_id);


--
-- Name: usuarios usuarios_rol_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_rol_id_fkey FOREIGN KEY (rol_id) REFERENCES public.rol(rol_id);


--
-- Name: usuarios usuarios_sex_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_sex_id_fkey FOREIGN KEY (sex_id) REFERENCES public.sexo(sex_id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

