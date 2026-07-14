#!/bin/bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"

check_group() {
  local name="$1"
  local dir="$2"
  local pattern1="$3"
  local pattern2="$4"

  local files
  files=$(find "$dir" -maxdepth 2 -type f \( -name "$pattern1" -o -name "$pattern2" \) | sort)

  local total=0
  local missing=0

  echo "[$name]"
  while IFS= read -r f; do
    [ -z "$f" ] && continue
    total=$((total+1))
    if ! rg -q '^Badge:' "$f"; then
      missing=$((missing+1))
      echo "MISSING $f"
    fi
  done <<< "$files"

  echo "SUMMARY $name missing=$missing total=$total"
  echo
}

check_single() {
  local name="$1"
  local file="$2"
  echo "[$name]"
  if rg -q '^Badge:' "$file"; then
    echo "SUMMARY $name missing=0 total=1"
  else
    echo "MISSING $file"
    echo "SUMMARY $name missing=1 total=1"
  fi
  echo
}

check_group "writes" "$ROOT/content/4-writes" "article.md" "article.txt"
check_group "did" "$ROOT/content/3-did" "project.md" "project.txt"
check_group "bikes" "$ROOT/content/bikes" "bike.md" "bike.txt"
check_single "about" "$ROOT/content/1-is/about.md"
